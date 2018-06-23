@extends("la.layouts.app")

@section("contentheader_title", "Mengelola Supplier")
@section("contentheader_description", "List")
@section("section", "Mengelola Supplier")
@section("sub_section", "List")
@section("htmlheader_title", "Mengelola Supplier")

@section("headerElems")

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
<div class="box box-primary">
    <div class="box-header">
        <div style="text-align: center;">
            <h3 class="box-title" style="font-weight: bold;">UBAH SUPPLIER</h3>
        </div>
    </div>
    <div class="box-body" ">
    	@include('flash::message')
        <div class="form-group row {{($errors->has('kode_supplier')? 'has-error' : '')}}">
            <label class="col-sm-2 col-sm-offset-2 control-label">
                Kode Supplier
            </label>
            <div style="display: -webkit-box;">
                {!! Form::text('kode_supplier', old('kode_supplier'), ['id' => 'kode_supplier', 'class' => 'form-control', 'placeholder' => 'Kode Supplier', 'style' => 'width:200px;']) !!}
                &nbsp;
                <input class="btn btn-primary" title="Cari" value="Cari" id="search_button" style="width: 50px;">
                <input class="btn btn-primary" title="Kode Supplier" value="Kode Supplier" id="search_button" style="width: 120px">
            </div>
        </div>
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true" >
            <thead>
                <tr>
                    <th class="center-align" width="15%">Kode Supplier</th>
                    <th class="center-align">Nama Supplier</th>
                    <th class="center-align" width="15%">Email</th>
                </tr>
            </thead>
        </table>
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
        "bFilter": false,
		processing: true,
        serverSide: true,
        ajax: "{{ route('datatables-list-supplier') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		}
	});
	$("#employee-add-form").validate({
		
	});
});

					
</script>
@endpush