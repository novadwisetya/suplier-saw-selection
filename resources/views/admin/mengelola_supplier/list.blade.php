@extends("la.layouts.app")

@section("contentheader_title", "Mengelola Supplier")
@section("contentheader_description", "List")
@section("section", "Mengelola Supplier")
@section("sub_section", "List")
@section("htmlheader_title", "Mengelola Supplier")

@section("headerElems")
@la_access("Employees", "create")
    <a class="btn btn-success btn-sm pull-right" href="{{route('admin-create-mengelola-supplier')}}">Tambah Supplier</a>
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
        <div class="pull-right">
            <a style="text-align:center;" data-id="6" data-button="show" class="btn btn-warning btn-sm">
                <i class="fa fa-print">Print</i>
            </a>
        </div>
    </div>
    <div class="box-body">
    	@include('flash::message')
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th width="4%" class="center-align">Id</th>
                    <th class="center-align" width="20%">Kode Supplier</th>
                    <th class="center-align" width="20%">Nama Supplier</th>
                    <th class="center-align" width="21%">Phone</th>
                    <th class="center-align" width="22%">Email</th>
                    <th class="center-align" width="14%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@la_access("Employees", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    Apakah anda yakin ingin menghapus data?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a id="buttonDelete" href="#" class="btn btn-success">Delete</a>
            </div>
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
        ajax: "{{ route('datatables-list-supplier') }}",
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
    })
});					
</script>

@include('admin.mengelola_supplier.show')
@endpush