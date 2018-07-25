<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\SubKriteria;
use App\Models\PenilaianSupplier;
use Datatables;
use DB;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use Excel;
use Dwij\Laraadmin\Helpers\LAHelper;
use PDF; 

class MengelolaSupplierController extends Controller
{
    protected $model;
    protected $views = 'mengelola_supplier';
    protected $routes = 'mengelola_supplier';
    protected $menu;

    public function __construct()
    {
        $this->model = new Supplier;
        $this->sub_kriteria = new SubKriteria;
        $this->products = new Product;
        $this->penilaian_supplier = new PenilaianSupplier;
    }

    public function index()
    {
        return view('admin.'.$this->views.'.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.'.$this->views.'.create');
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
            'kode_supplier' => 'required',
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $saveData = $this->model->create([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
        
        if(!empty($saveData)){
            flash()->success('Data berhasil disimpan!');
            return redirect()->route('admin-index-mengelola-supplier');
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-create-mengelola-supplier');
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
        return view('admin.'.$this->views.'.edit', ['data' => $data]);
    }

    public function penilaian($id)
    {
        $data = $this->model->find($id);
        return view('admin.laporan_perangkingan.penilaian', [
          'data' => $data,
          'id' => $id
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
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $data = $this->model->find($id);

        if(!empty($data)){
            $saveData = $data->update([
                'nama_supplier' => $request->nama_supplier,
                'alamat' => $request->alamat,
                'phone' => $request->phone,
                'email' => $request->email
            ]);
        }        
        
        if(!empty($saveData)){
            flash()->success('Data berhasil diperbaharui!');
            return redirect()->route('admin-index-mengelola-supplier');
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-create-mengelola-supplier');
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
        $barang = $this->products->where('suppliers_id', $id)->delete();
        $penilaian = $this->penilaian_supplier->where('suppliers_id', $id)->delete();
        
        if(!empty($data)){
            flash()->success('Data berhasil dihapus!');
            return redirect()->route('admin-index-mengelola-supplier');
        } else {
            flash()->error('Gagal menghapus data.!');
            return redirect()->route('admin-create-mengelola-supplier');
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

                $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/mengelola-supplier/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>&nbsp';

                $output .= '<a data-url="'.url(config('laraadmin.adminRoute') . '/mengelola-supplier/'.$data->data[$i][0].'/destroy').'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-trash"></i></a>&nbsp';

                $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/mengelola-supplier/'.$data->data[$i][0].'/penilaian').'" class="btn btn-primary btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>&nbsp';

                    
                $data->data[$i][] = (string)$output;
        }
        $out->setData($data);
        return $out;
    }

    public function dtMatrixKeputusan($id)
    {
        $values = $this->penilaian_supplier->datatables($id);
        $out = Datatables::of($values)
              ->editColumn('products_id', function($values) {
                  $products = $this->products->find($values->products_id);
                  $kode_barang = $products->kode_barang;
                  $nama_barang = $products->nama_barang;
                  return $kode_barang.' '.$nama_barang;
              })
              ->editColumn('harga', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->harga);
                  $nilai = $sub_kriteria->sub_kriteria;
                  return $nilai;
              })
              ->editColumn('mutu', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->mutu);
                  $nilai = $sub_kriteria->sub_kriteria;
                  return $nilai;
              })
              ->editColumn('layanan', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->layanan);
                  $nilai = $sub_kriteria->sub_kriteria;
                  return $nilai;
              })
              ->editColumn('pembayaran', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->pembayaran);
                  $nilai = $sub_kriteria->sub_kriteria;
                  return $nilai;
              })
              ->editColumn('waktu', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->waktu);
                  $nilai = $sub_kriteria->sub_kriteria;
                  return $nilai;
              })
              ->make();

        $data = $out->getData();
        $out->setData($data);
        return $out;
    }

    public function dtMatrixKeputusanX($id)
    {
        $values = $this->penilaian_supplier->datatables($id);
        $out = Datatables::of($values)
              ->editColumn('products_id', function($values) {
                  $products = $this->products->find($values->products_id);
                  $kode_barang = $products->kode_barang;
                  $nama_barang = $products->nama_barang;
                  return $kode_barang.' '.$nama_barang;
              })
              ->editColumn('harga', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->harga);
                  $nilai = $sub_kriteria->nilai;

                  return number_format((float)$nilai, 2, '.', '');
              })
              ->editColumn('mutu', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->mutu);
                  $nilai = $sub_kriteria->nilai;

                  return number_format((float)$nilai, 2, '.', '');
              })
              ->editColumn('layanan', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->layanan);
                  $nilai = $sub_kriteria->nilai;
                  return number_format((float)$nilai, 2, '.', '');
              })
              ->editColumn('pembayaran', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->pembayaran);
                  $nilai = $sub_kriteria->nilai;
                  return $nilai;
              })
              ->editColumn('waktu', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->waktu);
                  $nilai = $sub_kriteria->nilai;
                  return number_format((float)$nilai, 2, '.', '');
              })
              ->make();

        $data = $out->getData();
        $out->setData($data);
        return $out;
    }

    public function dtMatrixNormalisasiR($id)
    {
        $values = $this->penilaian_supplier->datatables($id);
        $out = Datatables::of($values)
              ->editColumn('products_id', function($values) {
                  $products = $this->products->find($values->products_id);
                  $kode_barang = $products->kode_barang;
                  $nama_barang = $products->nama_barang;
                  return $kode_barang.' '.$nama_barang;
              })
              ->editColumn('harga', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->harga);
                  $nilai = $sub_kriteria->nilai;
                  $dataNilai = [];

                  $alternative = $this->sub_kriteria->where('kriterias_id', 1)->get();

                  foreach ($alternative as $key => $value) {
                      $dataNilai[] = $value->nilai; 
                  }

                  $return = min($dataNilai) / $nilai;

                  return number_format((float)$return, 2, '.', '');
              })
              ->editColumn('mutu', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->mutu);
                  $nilai = $sub_kriteria->nilai;
                  $dataNilai = [];

                  $alternative = $this->sub_kriteria->where('kriterias_id', 2)->get();

                  foreach ($alternative as $key => $value) {
                      $dataNilai[] = $value->nilai; 
                  }

                  $return = $nilai / max($dataNilai);
                  return number_format((float)$return, 2, '.', '');
              })
              ->editColumn('layanan', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->layanan);
                  $nilai = $sub_kriteria->nilai;

                  $dataNilai = [];

                  $alternative = $this->sub_kriteria->where('kriterias_id', 3)->get();

                  foreach ($alternative as $key => $value) {
                      $dataNilai[] = $value->nilai; 
                  }

                  $return = $nilai / max($dataNilai);
                  return number_format((float)$return, 2, '.', '');
              })
              ->editColumn('pembayaran', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->pembayaran);
                  $nilai = $sub_kriteria->nilai;

                  $dataNilai = [];

                  $alternative = $this->sub_kriteria->where('kriterias_id', 4)->get();

                  foreach ($alternative as $key => $value) {
                      $dataNilai[] = $value->nilai; 
                  }

                  $return = $nilai / max($dataNilai);
                  return number_format((float)$return, 2, '.', '');

              })
              ->editColumn('waktu', function($values) {
                  $sub_kriteria = $this->sub_kriteria->find($values->waktu);
                  $nilai = $sub_kriteria->nilai;
                  $dataNilai = [];

                  $alternative = $this->sub_kriteria->where('kriterias_id', 4)->get();

                  foreach ($alternative as $key => $value) {
                      $dataNilai[] = $value->nilai; 
                  }

                  $return = $nilai / max($dataNilai);
                  return number_format((float)$return, 2, '.', '');
              })
              ->make();
        $data = $out->getData();
        $out->setData($data);
        return $out;
    }

    public function ajaxGetData($id)
    {
        $data = $this->model->find($id);
        
        if($data){
          return response()->json([
              'status' => 'success',
              'data' => $data
          ]);
        }else{
          return response()->json([
              'status' => 'failed'
          ]);
        }
    }

    public function import()
    {
        return view('admin.'.$this->views.'.import');
    }
    public function cetakData()
    {
        $items = DB::table("suppliers")->get();
        view()->share('suppliers',$items);

        $pdf = PDF::loadView('admin.'.$this->views.'.pdfview');
        return $pdf->download('list_supplier.pdf');
    }

    public function storeImport(Request $request)
    {
      if(isset($request->import)){
          $path = $request->import->getRealPath();

          $data = Excel::load($path, function($reader) {})->get();
          if(!empty($data) && $data->count()){
            foreach ($data as $key => $value) {
                $insert[] = [
                    'kode_supplier' => $value->kode_supplier,
                    'nama_supplier' => $value->nama_supplier,
                    'alamat' => $value->alamat,
                    'phone' => $value->phone,
                    'email' => $value->email

                ];
            }
            if(!empty($insert)){
              DB::table('suppliers')->insert($insert);
              flash()->success('Data berhasil disimpan!');
              return view('admin.'.$this->views.'.list');
            }
          }
      }

      // if(isset($request->import)){
      //     $path = $request->import->getRealPath();

      //     $data = Excel::load($path, function($reader) {})->get();
      //     if(!empty($data) && $data->count()){
      //       foreach ($data as $key => $value) {
      //           $insert[] = [
      //               'kode_barang' => $value->kode_barang,
      //               'nama_barang' => $value->nama_barang,
      //               'kategori_barang' => $value->kategori_barang,
      //               'jenis_barang' => $value->jenis_barang,
      //               'suppliers_id' => $value->suppliers_id
      //           ];
      //       }
      //       if(!empty($insert)){
      //         DB::table('products')->insert($insert);
      //         dd('Insert Record successfully.');
      //       }
      //     }
      // }

      // if(isset($request->import)){
      //     $path = $request->import->getRealPath();

      //     $data = Excel::load($path, function($reader) {})->get();
      //     if(!empty($data) && $data->count()){
      //       foreach ($data as $key => $value) {
      //           $insert[] = [
      //               'po_number' => $value->po_number,
      //               'suppliers_id' => $value->suppliers_id,
      //               'tanggal' => $value->tanggal,
      //               'products_id' => $value->products_id,
      //               'drum' => $value->drum,
      //               'kg' => $value->kg,
      //               'satuan' => $value->satuan,
      //               'jumlah' => $value->jumlah,
      //               'harga' => $value->harga,
      //               'mutu' => $value->mutu,
      //               'layanan' => $value->layanan,
      //               'pembayaran' => $value->pembayaran,
      //               'waktu' => $value->waktu
      //           ];
      //       }
      //       if(!empty($insert)){
      //         DB::table('penilaian_supplier')->insert($insert);
      //         dd('Insert Record successfully.');
      //       }
      //     }
      // }

      return back();

    }
}
