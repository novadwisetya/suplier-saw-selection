@extends("la.layouts.app")

@section("contentheader_title", "Mengelola Supplier")
@section("contentheader_description", "List")
@section("section", "Mengelola Supplier")
@section("sub_section", "List")
@section("htmlheader_title", "Mengelola Supplier")

@section("headerElems")
@la_access("Employees", "create")
    <a class="btn btn-success btn-sm pull-right" href="{{route('admin-create-mengelola-supplier')}}">Add Supplier</a>
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
            <h3 class="box-title" style="font-weight: bold;">DAFTAR SUPPLIER</h3>
        </div>
    </div>
    <div class="box-body">
    	@include('flash::message')
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th width="4%" class="center-align">Id</th>
                    <th class="center-align" width="15%">Kode Supplier</th>
                    <th class="center-align">Nama Supplier</th>
                    <th class="center-align" width="15%">Phone</th>
                    <th class="center-align" width="15%">Email</th>
                    <th class="center-align" width="15%">Action</th>
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

@include('admin.mengelola_supplier.show')
@endpush