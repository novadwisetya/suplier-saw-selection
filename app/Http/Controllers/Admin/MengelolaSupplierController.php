<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Datatables;
use DB;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use Dwij\Laraadmin\Helpers\LAHelper;

class MengelolaSupplierController extends Controller
{
    protected $model;
    protected $views = 'mengelola_supplier';
    protected $routes = 'mengelola_supplier';
    protected $menu;

    public function __construct()
    {
        $this->model = new Supplier;
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
            'kode_supplier' => 'required|max:13',
            'nama_supplier' => 'required|max:13',
            'alamat' => 'required|max:13',
            'phone' => 'required|max:13',
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

    public function datatables_edit()
    {
        $values = $this->model->dtedit();
        dd($values);
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
            'nama_supplier' => 'required|max:13',
            'alamat' => 'required|max:13',
            'phone' => 'required|max:13',
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
        //
    }

    public function datatables()
    {
        $values = $this->model->datatables();
        $out = Datatables::of($values)->make();
        $data = $out->getData();

        for($i=0; $i < count($data->data); $i++) {            
                $output = '';
                    $output .= '<a data-id="'.$data->data[$i][0].'" data-button="show" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>&nbsp';

                    $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/mengelola-supplier/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';

                    $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.employees.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                    $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                    $output .= Form::close();
                $data->data[$i][] = (string)$output;
        }
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
}
