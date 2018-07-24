<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Kriteria;
use App\Models\PenilaianSupplier;
use App\Models\SubKriteria;
use Datatables;
use DB;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use Dwij\Laraadmin\Helpers\LAHelper;
use PDF;

class LaporanPerangkinganController extends Controller
{
    protected $model;
    protected $views = 'laporan_perangkingan';
    protected $routes = 'laporan_perangkingan';
    protected $menu;

    public function __construct()
    {
        $this->model = new Product;
        $this->supplier = new Supplier;
        $this->kriteria= new Kriteria;
        $this->sub_kriteria= new SubKriteria;
        $this->penilaian_supplier = new PenilaianSupplier;
    }

    public function index()
    {
        $data = $this->model->groupBy('kategori_barang')->get();
        $output = [];
        foreach ($data as $key => $value) {
            $output[$value->kategori_barang] = $value->kategori_barang;
        }

        $supplier = $this->supplier->all();
        
        return view('admin.'.$this->views.'.index', [
            'kategori_barang' => $output,
            'supplier' => $supplier
        ]);
    }

    public function penilaian()
    {   
        return view('admin.'.$this->views.'.penilaian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = [];
        $supplier = $this->supplier->getData();

        foreach ($supplier as $key => $value) {
            $res[$value->id] = $value->kode_supplier.' - ' .$value->nama_supplier;
        }

        return view('admin.'.$this->views.'.create', ['data_supplier' => $res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saveData = $this->model->create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_barang' => $request->kategori_barang,
            'suppliers_id' => $request->suppliers_id,
            'jenis_barang' => $request->jenis_barang
        ]);
        
        if(!empty($saveData)){
            flash()->success('Data berhasil disimpan!');
            return redirect()->route('admin-index-mengelola-barang');
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-create-mengelola-barang');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);
        $supplier = $this->supplier->getData();

        foreach ($supplier as $key => $value) {
            $res[$value->id] = $value->kode_supplier.' - ' .$value->nama_supplier;
        }

        return view('admin.'.$this->views.'.edit', [
            'data' => $data,
            'supplier' => $res,
        ]);
    }

    public function datatables_edit()
    {
        $values = $this->model->dtedit();

        $out = Datatables::of($values)->make();
        $data = $out->getData();
        $out->setData($data);
        return $out;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'suppliers_id' => 'required',
            'jenis_barang' => 'required'
        ]);

        $data = $this->model->find($id);

        if(!empty($data)){
            $saveData = $data->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'kategori_barang' => $request->kategori_barang,
                'suppliers_id' => $request->suppliers_id,
                'jenis_barang' => $request->jenis_barang
            ]);
        }        
        
        if(!empty($saveData)){
            flash()->success('Data berhasil diperbaharui!');
            return redirect()->route('admin-index-mengelola-barang');
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-update-mengelola-supplier', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id)->delete();
        if(!empty($data)){
            flash()->success('Data berhasil dihapus!');
            return redirect()->route('admin-index-mengelola-barang');
        } else {
            flash()->error('Gagal menghapus data.!');
            return redirect()->route('admin-create-mengelola-barang');
        }
    }

    public function search(Request $request){
        $barang = $this->model->where('kategori_barang', $request->kategori_barang)->get()->toArray();
        $kategori_barang_id = [];
        $output =[];

        foreach ($barang as $key => $value) {
            $kategori_barang_id[] = $value['id'];
        }

        $penilaianGlobal = [];
        $penilaianSupplier = [];
        foreach ($kategori_barang_id as $key => $value) {
            $penilaian = $this->penilaian_supplier->where('products_id', $value);

            if($request->bulan != '' && $request->tahun != ''){
                $penilaian = $penilaian->whereDate('tanggal', '>=', date($request->tahun.'-'.$request->bulan.'-1'));
                $penilaian = $penilaian->whereDate('tanggal', '<=', date($request->tahun.'-'.$request->bulan.'-28'));
            }elseif($request->tahun != ''){
                $penilaian = $penilaian->whereDate('tanggal', '>=', date($request->tahun.'-1-1'));
                $penilaian = $penilaian->whereDate('tanggal', '<=', date($request->tahun.'-12-21'));
            }

            if(!empty($penilaian->get()->toArray())){
                $penilaianGlobal[] = $penilaian->get()->toArray()[0];
            }
            
        }

        foreach ($penilaianGlobal as $key => $value) {
            $penilaianSupplier[$value['suppliers_id']][] = $value;
        }

        foreach ($penilaianSupplier as $key => $value) {
            $hargaGlobal = [];
            $harga = 0;
            $mutu = 0;
            $mutuGlobal = [];
            $layanan = 0;
            $layananGlobal = [];
            $pembayaran = 0;
            $pembayaranGlobal = [];
            $waktu = 0;
            $waktuGlobal = [];

            foreach ($value as $key1 => $value1) {
                //harga
                $sub_kriteria = $this->sub_kriteria->find($value1['harga']);
                $nilai = $sub_kriteria->nilai;
                $dataNilai = [];
                $alternative = $this->sub_kriteria->where('kriterias_id', 1)->get();

                foreach ($alternative as $key2 => $value2) {
                    $dataNilai[] = $value2->nilai; 
                }

                $hargaGlobal[] = min($dataNilai) / $nilai;

                //mutu
                $sub_kriteria = $this->sub_kriteria->find($value1['mutu']);
                $nilai = $sub_kriteria->nilai;
                $dataNilai = [];

                $alternative = $this->sub_kriteria->where('kriterias_id', 2)->get();

                foreach ($alternative as $key2 => $value2) {
                    $dataNilai[] = $value2->nilai; 
                }
                $mutuGlobal[] = $nilai / max($dataNilai);

                //layanan
                $sub_kriteria = $this->sub_kriteria->find($value1['layanan']);
                $nilai = $sub_kriteria->nilai;
                $dataNilai = [];

                $alternative = $this->sub_kriteria->where('kriterias_id', 3)->get();
                foreach ($alternative as $key2 => $value2) {
                    $dataNilai[] = $value2->nilai; 
                }
                $layananGlobal[] = $nilai/max($dataNilai);
                //pembayaran
                $sub_kriteria = $this->sub_kriteria->find($value1['pembayaran']);
                $nilai = $sub_kriteria->nilai;
                $dataNilai = [];
                $alternative = $this->sub_kriteria->where('kriterias_id', 4)->get();

                foreach ($alternative as $key2 => $value2) {
                    $dataNilai[] = $value2->nilai; 
                }
                $pembayaranGlobal[] = $nilai / max($dataNilai);
                //waktu
                $sub_kriteria = $this->sub_kriteria->find($value1['waktu']);
                $nilai = $sub_kriteria->nilai;
                $dataNilai = [];
                $alternative = $this->sub_kriteria->where('kriterias_id', 5)->get();
                foreach ($alternative as $key2 => $value2) {
                    $dataNilai[] = $value2->nilai; 
                }

                $waktuGlobal[] = $nilai / max($dataNilai);
            }

            //total harga
            foreach ($hargaGlobal as $key8 => $value8) {
                $harga = $harga+$value8;
            }
            $harga = $harga/count($hargaGlobal);
            $kriteria = $this->kriteria->find(1);
            $harga = $harga * $kriteria->bobot;

            //total Mutu
            foreach ($mutuGlobal as $key8 => $value8) {
                $mutu = $mutu+$value8;
            }
            $mutu = $mutu/count($mutuGlobal);
            $kriteria = $this->kriteria->find(2);
            $mutu = $mutu * $kriteria->bobot;

            //total layanan
            foreach ($layananGlobal as $key8 => $value8) {
                $layanan = $layanan+$value8;
            }

            $layanan = $layanan/count($layananGlobal);
            $kriteria = $this->kriteria->find(4);
            $layanan = $layanan * $kriteria->bobot;

            //total pembayaran
            foreach ($pembayaranGlobal as $key8 => $value8) {
                $pembayaran = $pembayaran+$value8;
            }

            $pembayaran = $pembayaran/count($pembayaranGlobal);
            $kriteria = $this->kriteria->find(4);
            $pembayaran = $pembayaran * $kriteria->bobot;

            foreach ($waktuGlobal as $ke8 => $value8) {
                $waktu = $waktu+$value8;
            }

            $waktu = $waktu/count($waktuGlobal);
            $kriteria = $this->kriteria->find(5);
            $waktu = $waktu * $kriteria->bobot;
                
            $point = $harga+$mutu+$layanan+$pembayaran+$waktu;
            $supplier = $this->supplier->find($key)->toArray();

            
            $output[$key]['kode_supplier'] = $supplier['kode_supplier'];
            $output[$key]['nama_supplier'] = $supplier['nama_supplier'];
            $output[$key]['point'] = number_format($point, 3);
        }

        $peringkat = [];
        foreach ($output as $k => $v) {
            $peringkat[] = $v['point']; 
        }

        arsort($peringkat);

        $return = [];
        foreach ($peringkat as $key => $value) {
            foreach ($output as $key1 => $value1) {
                if($value1['point'] == $value){
                    $return[] = $value1;
                } 
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $return
        ]);
    }

    public function laporan_perangkingan()
    {
        $data = $this->penilaian_supplier->all();

        $values = $this->supplier->laporan_perangkingan();
        $out = Datatables::of($values)
            ->editColumn('point', function($values) {
                $penilaian = $this->penilaian_supplier->where('suppliers_id', $values->id)->get();

                //harga
                $harga = 0;
                $hargaGlobal = [];
                foreach ($penilaian as $key => $value) {
                    $sub_kriteria = $this->sub_kriteria->find($value->harga);
                    $nilai = $sub_kriteria->nilai;
                    $dataNilai = [];

                    $alternative = $this->sub_kriteria->where('kriterias_id', 1)->get();

                    foreach ($alternative as $key1 => $value1) {
                        $dataNilai[] = $value1->nilai; 
                    }

                    $hargaGlobal[] = min($dataNilai) / $nilai;
                }

                foreach ($hargaGlobal as $key => $value) {
                    $harga = $harga+$value;
                }

                $harga = $harga/count($hargaGlobal);

                $kriteria = $this->kriteria->find(1);
                $harga = $harga * $kriteria->bobot;

                //mutu
                $mutu = 0;
                $mutuGlobal = [];

                foreach ($penilaian as $key => $value) {
                    $sub_kriteria = $this->sub_kriteria->find($value->mutu);
                    $nilai = $sub_kriteria->nilai;
                    $dataNilai = [];

                    $alternative = $this->sub_kriteria->where('kriterias_id', 2)->get();

                    foreach ($alternative as $key1 => $value1) {
                        $dataNilai[] = $value1->nilai; 
                    }

                    $mutuGlobal[] = $nilai / max($dataNilai);
                }
                
                foreach ($mutuGlobal as $key => $value) {
                    $mutu = $mutu+$value;
                }
                $mutu = $mutu/count($mutuGlobal);
                $kriteria = $this->kriteria->find(2);
                $mutu = $mutu * $kriteria->bobot;
                
                //layanan
                $layanan = 0;
                $layananGlobal = [];

                foreach ($penilaian as $key => $value) {
                    $sub_kriteria = $this->sub_kriteria->find($value->layanan);
                    $nilai = $sub_kriteria->nilai;

                    $dataNilai = [];

                    $alternative = $this->sub_kriteria->where('kriterias_id', 3)->get();

                    foreach ($alternative as $key1 => $value1) {
                        $dataNilai[] = $value1->nilai; 
                    }

                    $layananGlobal[] = $nilai / max($dataNilai);
                }
                
                foreach ($layananGlobal as $key => $value) {
                    $layanan = $layanan+$value;
                }

                $layanan = $layanan/count($layananGlobal);
                $kriteria = $this->kriteria->find(4);
                $layanan = $layanan * $kriteria->bobot;

                //pembayaran
                $pembayaran = 0;
                $pembayaranGlobal = [];

                foreach ($penilaian as $key => $value) {
                    $sub_kriteria = $this->sub_kriteria->find($value->pembayaran);
                    $nilai = $sub_kriteria->nilai;

                    $dataNilai = [];

                    $alternative = $this->sub_kriteria->where('kriterias_id', 4)->get();

                    foreach ($alternative as $key1 => $value1) {
                        $dataNilai[] = $value1->nilai; 
                    }

                    $pembayaranGlobal[] = $nilai / max($dataNilai);
                }
                
                foreach ($pembayaranGlobal as $key => $value) {
                    $pembayaran = $pembayaran+$value;
                }

                $pembayaran = $pembayaran/count($pembayaranGlobal);
                $kriteria = $this->kriteria->find(4);
                $pembayaran = $pembayaran * $kriteria->bobot;

                //waktu
                $waktu = 0;
                $waktuGlobal = [];
                foreach ($penilaian as $key => $value) {
                    $sub_kriteria = $this->sub_kriteria->find($value->waktu);
                    $nilai = $sub_kriteria->nilai;
                    $dataNilai = [];

                    $alternative = $this->sub_kriteria->where('kriterias_id', 5)->get();

                    foreach ($alternative as $key => $value) {
                        $dataNilai[] = $value->nilai; 
                    }

                    $waktuGlobal[] = $nilai / max($dataNilai);
                }
                
                foreach ($waktuGlobal as $key => $value) {
                    $waktu = $waktu+$value;
                }

                $waktu = $waktu/count($waktuGlobal);
                $kriteria = $this->kriteria->find(5);
                $waktu = $waktu * $kriteria->bobot;
                
                $return = $harga+$mutu+$layanan+$pembayaran+$waktu;
                return $return;
            })
            ->editColumn('peringkat', function($values) {
                  $penilaian = $this->penilaian_supplier->where('suppliers_id', $values->id);

                  return '';
            })
            ->make();

        $data = $out->getData();
        $out->setData($data);

        return $out;
    }

    public function ajaxGetDataBarang($supplier_id)
    {
        $data = $this->model->where('suppliers_id', $supplier_id)->get()->toArray();
        $res = [];
        
        if(!empty($data)){
          foreach ($data as $key => $value) {
              $res[$value['id']] = $value['kode_barang'].' - '.$value['nama_barang'];
          }
        }

        return response()->json([
            'status' => 'success',
            'data' => $res
        ]);
    }

    public function print()
    {   
        
        $pdf = PDF::loadView('admin.'.$this->views.'.pdfview');
        return $pdf->download('list_barang.pdf');
    }
}
