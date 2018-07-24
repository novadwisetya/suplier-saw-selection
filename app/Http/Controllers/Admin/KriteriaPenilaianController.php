<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Datatables;
use DB;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use Dwij\Laraadmin\Helpers\LAHelper;

class KriteriaPenilaianController extends Controller
{
    protected $model;
    protected $views = 'kriteria_penilaian';
    protected $routes = 'kriteria_penilaian';
    protected $menu;

    public function __construct()
    {
        $this->model = new Kriteria;
        $this->sub_kriteria = new SubKriteria;
    }

    public function index()
    {
        return view('admin.'.$this->views.'.index');
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
            'kriteria' => 'required',
            'bobot' => 'required',
            'keterangan' => 'required'
        ]);


        $saveData = $this->model->create([
            'kriteria' => $request->kriteria,
            'bobot' => $request->bobot,
            'keterangan' => $request->keterangan,
        ]);
        
        if(!empty($saveData)){
            flash()->success('Data berhasil disimpan!');
            return redirect()->route('admin-index-kriteria-penilaian');
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-index-kriteria-penilaian');
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
            'kriteria' => 'required',
            'bobot' => 'required',
            'keterangan' => 'required'
        ]);

        $data = $this->model->find($id);

        if(!empty($data)){
            $saveData = $data->update([
                'kriteria' => $request->kriteria,
                'bobot' => $request->bobot,
                'keterangan' => $request->keterangan,
            ]);
        }        
        
        if(!empty($saveData)){
            flash()->success('Data berhasil diperbaharui!');
            return redirect()->route('admin-index-kriteria-penilaian');
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-index-kriteria-penilaian');
        }
    }

    public function updateSubKriteria(Request $request, $id, $parent_id)
    {
        $data = $this->sub_kriteria->find($id);
        if(!empty($data)){
            $saveData = $data->update([
                'kriterias_id' => $request->kriterias_id,
                'sub_kriteria' => $request->sub_kriteria,
                'nilai' => $request->nilai,
                'kriteria_nilai' => $request->kriteria_nilai
            ]);
        }        
        
        if(!empty($saveData)){
            flash()->success('Data berhasil diperbaharui!');
            return redirect()->route('admin-detail-kriteria-penilaian', $parent_id);
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-detail-kriteria-penilaian', $parent_id);
        }
    }


    public function detail($id)
    {
        $data = $this->model->findOrFail($id);

        if(!empty($data)){
            return view('admin.'.$this->views.'.detail', ['data' => $data]);
        } else {
            flash()->error('Gagal menghapus data.!');
            return redirect()->route('admin-index-kriteria-penilaian');
        }
    }

    public function datatables()
    {
        $values = $this->model->datatables();
        $out = Datatables::of($values)->editColumn('keterangan', function($values) {
                  return ucwords($values->keterangan);
              })->make();
        $data = $out->getData();

        for($i=0; $i < count($data->data); $i++) {            
          $output = '';
          $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/kriteria-penilaian/'.$data->data[$i][0].'/detail').'" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';

          // $output .= '<a class="btn btn-warning btn-xs btn-edit" data-id="'.$data->data[$i][0].'" data-toggle="modal" data-target="#EditModal" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>&nbsp';

          // $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/kriteria-penilaian/'.$data->data[$i][0].'/destroy').'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-trash"></i></a>';
                    
                $data->data[$i][] = (string)$output;
        }
        $out->setData($data);
        return $out;
    }

    public function detailDatatables($id)
    {
        $values = $this->sub_kriteria->datatables($id);
        $out = Datatables::of($values)->make();
        $data = $out->getData();

        for($i=0; $i < count($data->data); $i++) {            
          $output = '';
          $output .= '<a class="btn btn-warning btn-xs btn-edit" data-parent-id="'.$id.'" data-id="'.$data->data[$i][0].'" data-toggle="modal" data-target="#EditModal" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>&nbsp';


          $output .= '<a href="'.url(config('laraadmin.adminRoute') . '/kriteria-penilaian/'.$data->data[$i][0].'/'.$id.'/destroy-sub-kriteria').'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-trash"></i></a>';
                    
                $data->data[$i][] = (string)$output;
        }

        $out->setData($data);
        return $out;
    }

    public function detailCostDatatables($id)
    {
        $values = $this->sub_kriteria->datatables($id);
        $out = Datatables::of($values)->make();
        $data = $out->getData();

        for($i=0; $i < count($data->data); $i++) {            
          $output = '';
          $output .= '<a class="btn btn-warning btn-xs btn-edit" data-parent-id="'.$id.'" data-id="'.$data->data[$i][0].'" data-toggle="modal" data-target="#EditModal" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>&nbsp';
                    
          $data->data[$i][] = (string)$output;
        }
        
        $out->setData($data);
        return $out;
    }

    public function ajaxGetKriteria($id)
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

    public function ajaxGetSubKriteria($id)
    {
        $data = $this->sub_kriteria->find($id);
        
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

    public function store_sub_kriteria(Request $request)
    {
        $saveData = $this->sub_kriteria->create([
            'kriterias_id' => $request->kriterias_id,
            'sub_kriteria' => $request->sub_kriteria,
            'nilai' => $request->nilai,
            'kriteria_nilai' => $request->kriteria_nilai
        ]);
        
        if(!empty($saveData)){
            flash()->success('Data berhasil disimpan!');
            return redirect()->route('admin-detail-kriteria-penilaian', $request->kriterias_id);
        } else {
            flash()->error('Gagal menyimpan data.!');
            return redirect()->route('admin-detail-kriteria-penilaian', $request->kriterias_id);
        } 
    }

    public function destroy_sub_kriteria($id, $parent_id)
    {
        $data = $this->sub_kriteria->find($id);
        if(!empty($data)){
            $data->delete();
        }
        
        if(!empty($data)){
            flash()->success('Data berhasil dihapus!');
            return redirect()->route('admin-detail-kriteria-penilaian', $parent_id);
        } else {
            flash()->error('Gagal menghapus data.!');
            return redirect()->route('admin-detail-kriteria-penilaian', $parent_id);
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
        $data = $this->model->find($id);
        if(!empty($data)){
            $data->delete();
        }
        
        if(!empty($data)){
            flash()->success('Data berhasil dihapus!');
            return redirect()->route('admin-index-kriteria-penilaian');
        } else {
            flash()->error('Gagal menghapus data.!');
            return redirect()->route('admin-index-kriteria-penilaian');
        }
    }
}
