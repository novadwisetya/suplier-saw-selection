    @extends("la.layouts.app")

@section("contentheader_title", "Sub Kriteria Penilaian")
@section("contentheader_description", "Detail")
@section("section", "Sub Kriteria Penilaian")
@section("sub_section", "Detail")
@section("htmlheader_title", "Sub Kriteria Penilaian")

@section("headerElems")
    @if($data->keterangan != 'cost')
    <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Tambah Sub Kriteria</button>
    @endif

@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box box-success">
    <div class="box-header">
        <div style="text-align: center;">
           
        </div>
        <div style="margin-top: 30px;">
            <div class="form-group row">
                <label class="col-sm-2 control-label" style="float: left;">
                    DETAIL KRITERIA
                </label>
                <label class="col-sm-10" style="font-weight: 500;">
                    {{ strtoupper($data->kriteria)}}
                </label>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" style="float: left;">
                    BOBOT
                </label>
                <label class="col-sm-10" style="font-weight: 500;">
                    {{ strtoupper($data->bobot)}}
                </label>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" style="float: left;">
                    KETERANGAN
                </label>
                <label class="col-sm-10" style="font-weight: 500;">
                    {{ strtoupper($data->keterangan)}}
                </label>
            </div>
        </div>
    </div>
    <div class="box-body">
    	@include('flash::message')
        @if($data->keterangan != 'cost')
            <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align" width="3%">Id</th>
                        <th class="center-align" width="43%">Sub Kriteria</th>
                        <th class="center-align" width="20%">Nilai</th>
                        <th class="center-align" width="43%">Kriteria Nilai</th>
                        <th class="center-align" width="9%">Aksi</th>
                    </tr>
                </thead>
            </table>
        @else
            <table id="table-cost-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align" width="3%">Id</th>
                        <th class="center-align" width="43%">Sub Kriteria</th>
                        <th class="center-align" width="20%">Nilai</th>
                        <th class="center-align" width="43%">Kriteria Nilai</th>
                        <th class="center-align" width="9%">Aksi</th>
                    </tr>
                </thead>
            </table>
        @endif

    </div>
    <div class="box-footer">
        <a href="{{ url(config('laraadmin.adminRoute')) }}" class="btn btn-warning">Menu Utama</a>
    </div>
</div>

<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Sub Kriteria</h4>
            </div>

            {!! Form::open(['action' => 'Admin\KriteriaPenilaianController@store_sub_kriteria', 'id' => 'form-add-sub-kriteria']) !!}

            <div class="modal-body">
                <div class="box-body">
                    {!! Form::hidden('kriterias_id', $data->id) !!}
                    <div class="form-group row {{($errors->has('sub_kriteria')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Sub Kriteria
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::text('sub_kriteria', old('sub_kriteria'), ['id' => 'add_sub_kriteria', 'class' => 'form-control', 'placeholder' => 'Sub Kriteria', 'required']) !!}

                            @if ($errors->has('sub_kriteria'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sub_kriteria') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('nilai')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Nilai
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::number('nilai', old('nilai'), ['id' => 'add_nilai', 'class' => 'form-control', 'placeholder' => 'Nilai', 'step' => '.01', 'min' => '0', 'max' => '1', 'required']) !!}

                            @if ($errors->has('nilai'))
                                <span class="help-block">
                                    <strong>{{$errors->first('nilai')}}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('kriteria_nilai')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Kriteria Nilai
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::text('kriteria_nilai', old('kriteria_nilai'), ['id' => 'add_kriteria_nilai', 'class' => 'form-control', 'placeholder' => 'Kriteria Nilai', 'required', 'maxlength' => '30']) !!}

                            @if ($errors->has('kriteria_nilai'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kriteria_nilai') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                {!! Form::submit( 'Simpan', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="EditModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Sub Kriteria</h4>
            </div>

            {!! Form::open(['action' => 'Admin\KriteriaPenilaianController@store_sub_kriteria', 'id' => 'form-sub-kriteria']) !!}

            <div class="modal-body">
                <div class="box-body">
                    {!! Form::hidden('kriterias_id', $data->id) !!}
                    <div class="form-group row {{($errors->has('sub_kriteria')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Sub Kriteria
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::text('sub_kriteria', old('sub_kriteria'), ['id' => 'sub_kriteria', 'class' => 'form-control', 'placeholder' => 'Sub Kriteria', 'required']) !!}

                            @if ($errors->has('sub_kriteria'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sub_kriteria') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('nilai')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Nilai
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::number('nilai', old('nilai'), ['id' => 'nilai', 'class' => 'form-control', 'placeholder' => 'Nilai', 'step' => '.01', 'min' => '0', 'max' => '1', 'required']) !!}

                            @if ($errors->has('nilai'))
                                <span class="help-block">
                                    <strong>{{$errors->first('nilai')}}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('kriteria_nilai')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Kriteria Nilai
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::text('kriteria_nilai', old('kriteria_nilai'), ['id' => 'kriteria_nilai', 'class' => 'form-control', 'placeholder' => 'Kriteria Nilai', 'required', 'maxlength' => '30']) !!}

                            @if ($errors->has('kriteria_nilai'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kriteria_nilai') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                {!! Form::submit( 'Simpan', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Pesan Hapus</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    Apakah anda yakin ingin menghapus data?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak Setuju</button>
                <a id="buttonDelete" href="#" class="btn btn-success">Setuju</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('la-assets/plugins/datatables/datatables.min.css')}}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
    $("#table-container").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables-list-sub-kriteria-penilaian', $data->id) }}",
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search"
        }
    });
    $("#table-cost-container").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables-list-sub-kriteria-penilaian-cost', $data->id) }}",
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search"
        }
    });
    $("#employee-add-form").validate({
        
    });

    $(document).on('click', '.btn-edit', function(){
        var id = $(this).data('id');
        var parentId = $(this).data('parent-id');

        var url = "{{route('ajax-get-data-sub-kriteria', ':id')}}";
        var urlEdit = "{{route('admin-update-sub-kriteria-penilaian', [':id', ':parentId'])}}";

        url = url.replace(':id', id);
        urlEdit = urlEdit.replace(':id', id);
        urlEdit = urlEdit.replace(':parentId', parentId);

        $.get(url, function(data, status){
            $('#form-sub-kriteria').attr('action', urlEdit);
            $('#sub_kriteria').val(data.data.sub_kriteria);
            $('#nilai').val(data.data.nilai);
            $('#kriteria_nilai').val(data.data.kriteria_nilai);
        });
    });

    $(document).on('click', '.btn-danger', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('#buttonDelete').attr('href', url)
        $('#DeleteModal').modal('show');

    })
});                 
</script>
@endpush