@extends("la.layouts.app")

@section("contentheader_title", "Kriteria Penilaian")
@section("contentheader_description", "")
@section("section", "Kriteria Penilaian")
@section("sub_section", "")
@section("htmlheader_title", "Kriteria Penilaian")

@section("headerElems")
@la_access("Employees", "create")
    <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Tambah Kriteria</button>
@endla_access

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
            <h3 class="box-title" style="font-weight: bold;">Kriteria Penilaian</h3>
        </div>
    </div>
    <div class="box-body">
    	@include('flash::message')
        <div class="col-sm-8 col-sm-offset-2">
            <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align" width="3%">Id</th>
                        <th class="center-align" width="46%">Kriteria</th>
                        <th class="center-align" width="43%">Bobot</th>
                        <th class="center-align" width="43%">Keterangan</th>
                        <th class="center-align" width="9%">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@la_access("Employees", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Kriteria</h4>
            </div>

            {!! Form::open(['action' => 'Admin\KriteriaPenilaianController@store', 'id' => 'add_form-kriteria']) !!}
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group row {{($errors->has('kriteria')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Kriteria
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::text('kriteria', null, ['id' => 'add_kriteria', 'class' => 'form-control', 'placeholder' => 'Kriteria', 'required']) !!}

                            @if ($errors->has('kriteria'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kriteria') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('bobot')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Bobot
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::number('bobot', null, ['id' => 'add_bobot', 'class' => 'form-control', 'placeholder' => 'Nilai', 'step' => '.01', 'min' => '0', 'required']) !!}

                            @if ($errors->has('nilai'))
                                <span class="help-block">
                                    <strong>{{$errors->first('nilai')}}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('kriteria_nilai')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Keterangan
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <select id="add_keterangan" class="form-control" name="keterangan" required>
                                <option value="">Pilih</option>
                                <option value="cost">Kriteria Cost</option>
                                <option value="benefit">Kriteria Benefit</option>
                            </select>

                            @if ($errors->has('keterangan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kriteria_nilai') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="EditModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Kriteria</h4>
            </div>

            {!! Form::open(['action' => 'Admin\KriteriaPenilaianController@store', 'id' => 'form-kriteria']) !!}
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group row {{($errors->has('kriteria')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Kriteria
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::text('kriteria', null, ['id' => 'kriteria', 'class' => 'form-control', 'placeholder' => 'Kriteria', 'required']) !!}

                            @if ($errors->has('kriteria'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kriteria') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('bobot')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Bobot
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            {!! Form::number('bobot', null, ['id' => 'bobot', 'class' => 'form-control', 'placeholder' => 'Nilai', 'step' => '.01', 'min' => '0', 'required']) !!}

                            @if ($errors->has('nilai'))
                                <span class="help-block">
                                    <strong>{{$errors->first('nilai')}}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('kriteria_nilai')? 'has-error' : '')}}">
                        <label class="col-sm-4 control-label">
                            Keterangan
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <select id="keterangan" class="form-control" name="keterangan" required>
                                <option value="">Pilih</option>
                                <option value="cost">Kriteria Cost</option>
                                <option value="benefit">Kriteria Benefit</option>
                            </select>

                            @if ($errors->has('keterangan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kriteria_nilai') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endla_access
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
        "bPaginate": false,
        "searching": false,
        ajax: "{{ route('datatables-list-kriteria-penilaian') }}",
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
        var url = "{{route('ajax-get-data-kriteria', ':id')}}";
        var urlEdit = "{{route('admin-update-kriteria-penilaian', ':id')}}";
        url = url.replace(':id', id);
        urlEdit = urlEdit.replace(':id', id);


        $.get(url, function(data, status){
            $('#form-kriteria').attr('action', urlEdit);
            $('#kriteria').val(data.data.kriteria);
            $('#bobot').val(data.data.bobot);
            $('#keterangan').val(data.data.keterangan);
        });
    });
});                 
</script>


@include('admin.mengelola_barang.show')
@endpush