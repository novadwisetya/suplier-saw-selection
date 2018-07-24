<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\PenilaianSupplier;
use Datatables;
use DB;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use Dwij\Laraadmin\Helpers\LAHelper;

class MengelolaPenilaianSupplierController extends Controller
{
    protected $model;
    protected $views = 'mengelola_penilaian_supplier';
    protected $routes = 'mengelola_penilaian_supplier';
    protected $menu;

    public function __construct()
    {
        $this->model = new Product;
        $this->penilaian_supplier = new PenilaianSupplier;  
        $this->supplier = new Supplier;
        $this->kriteria= new Kriteria;
        $this->sub_kriteria= new SubKriteria;
    }

    public function index()
    {
        $res = [];
        $mutu = [];
        $layanan = [];
        $pembayaran = [];
        $waktu = [];

        $supplier = $this->supplier->getData();

        foreach ($supplier as $key => $value) {
            $res[$value->id] = $value->kode_supplier.' - ' .$value->nama_supplier;
        }

        $kriteria = $this->kriteria->get();
        foreach ($kriteria as $value) {
            switch ($value->kriteria) {
              case 'Mutu':
                $query_mutu = $this->sub_kriteria->where('kriterias_id', $value->id)->get();

                foreach ($query_mutu as $key1 => $value1) {
                    $mutu[$value1->id] = $value1->sub_kriteria;
                }

                break;
              case 'Layanan':
                $query_layanan = $this->sub_kriteria->where('kriterias_id', $value->id)->get();

                foreach ($query_layanan as $key1 => $value1) {
                    $layanan[$value1->id] = $value1->sub_kriteria;
                }

                break;
              case 'Pembayaran':
                $query_pembayaran = $this->sub_kriteria->where('kriterias_id', $value->id)->get();

                foreach ($query_pembayaran as $key1 => $value1) {
                    $pembayaran[$value1->id] = $value1->sub_kriteria;
                }

                break;
              case 'Waktu':
                $query_waktu = $this->sub_kriteria->where('kriterias_id', $value->id)->get();

                foreach ($query_waktu as $key1 => $value1) {
                    $waktu[$value1->id] = $value1->sub_kriteria;
                }

                break;
            }
        }

        return view('admin.'.$this->views.'.index', [
            'data_supplier' => $res,
            'mutu' => $mutu,
            'layanan' => $layanan,
            'pembayaran' => $pembayaran,
            'waktu' => $waktu
        ]);
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
        $this->validate($request, [
            'po_number' => 'required',
            'suppliers_id' => 'required',
            'tanggal' => 'required',
        ]);

        foreach ($request->penilaian as $key => $value) {
            $hargaSatuan = (int)$value['satuan'];


            if($hargaSatuan <= 31000){
                $harga = 1;
            }elseif($hargaSatuan >= 31000 && $hargaSatuan <= 35000){
                $harga = 2;
            }else{
                $harga = 3;
            }


            $this->penilaian_supplier->create([
                'po_number' => $request->po_number,
                'suppliers_id' => $request->suppliers_id,
                'tanggal' => $request->tanggal,
                'products_id' => (int)$value['products_id'],
                'drum' => (int)$value['drum'],
                'kg' => (int)$value['kg'],
                'satuan' => (int)$value['satuan'],
                'jumlah' => (int)$value['jumlah'],
                'harga' => $harga,
                'mutu' => (int)$value['mutu'],
                'layanan' => (int)$value['layanan'],
                'pembayaran' => (int)$value['pembayaran'],
                'waktu' => (int)$value['waktu']
            ]);
        }
        
        flash()->success('Data berhasil disimpan!');
        return redirect()->route('admin-index-mengelola-penilaian-supplier');
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

    public function datatables()
    {
        $values = $this->model->datatables();
        $out = Datatables::of($values)->make();
        $data = $out->getData();

        for($i=0; $i < count($data->data); $i++) {            
                $output = '';
                $output .= '<a style="text-align:center;" data-id="'.$data->data[$i][0].'" data-button="show" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>&nbsp';

                $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/mengelola-barang/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>&nbsp';

                $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/mengelola-barang/'.$data->data[$i][0].'/destroy').'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-trash"></i></a>';
                    
                $data->data[$i][] = (string)$output;
        }
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
}
