@extends("la.layouts.app")

@section("contentheader_title", "Kelola Data Barang")
@section("contentheader_description", "List")
@section("section", "Kelola Data Barang")
@section("sub_section", "List")
@section("htmlheader_title", "Kelola Data Barang")

@section("headerElems")
<a class="btn btn-success btn-sm pull-right" href="{{route('admin-create-mengelola-barang')}}">Tambah Barang</a>

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
            <h3 class="box-title" style="font-weight: bold;">DAFTAR BARANG</h3>
        </div>
        <div class="pull-right">
            <a id="import" style="text-align:center;" data-id="6" data-button="show" class="btn btn-success btn-sm">
                <i class="fa fa-upload">&nbsp;Import Data Barang</i>
            </a>
            <a href="{{route('product-print-pdf')}}" style="text-align:center;" data-id="6" data-button="show" class="btn btn-warning btn-sm">
                <i class="fa fa-print">&nbsp;Cetak Data Barang</i>
            </a>
        </div>
    </div>
    <div class="box-body">
    	@include('flash::message')
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th width="4%" class="center-align">Id</th>
                    <th class="center-align" width="20%">Kode Barang</th>
                    <th class="center-align" width="20%">Nama Barang</th>
                    <th class="center-align" width="21%">Kategori</th>
                    <th class="center-align" width="26%">Jenis</th>
                    <th class="center-align" width="9%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
        <div class="box-footer">
        <a href="{{ url(config('laraadmin.adminRoute')) }}" class="btn btn-warning">Menu Utama</a>
    </div>
</div>

<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak setuju</button>
                <a id="buttonDelete" href="#" class="btn btn-success">Setuju</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ImportModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Import Data Barang</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => route('admin-import-tambah-barang'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-container', 'files'=>true)) !!}
                <div class="box-body">
                @include('flash::message')
                    <div class="form-group row {{($errors->has('import')? 'has-error' : '')}}">
                        <label class="col-sm-3 control-label">
                            Data Barang
                        </label>
                        <div class="col-sm-6">
                            {!! Form::file('import', ['accept' => '.xlsx', 'required']) !!}

                            @if ($errors->has('import'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('import') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                </div>
                <div class="box-footer">
                    <input class="btn btn-primary pull-right" title="Import" type="submit" value="Import" id="button_submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 5px;">Batal</button>&nbsp;

                </div>
            {!! Form::close() !!}
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
        ajax: "{{ route('datatables-list-barang') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		}
	});
	$("#employee-add-form").validate({
		
	});

    $(document).on('click', '.btn-danger', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('#buttonDelete').attr('href', url)
        $('#AddModal').modal('show');
    });

    $(document).on('click', '#import', function(e){
        e.preventDefault();
        $('#ImportModal').modal('show');
    });
});					
</script>

@include('admin.mengelola_barang.show')
@endpush