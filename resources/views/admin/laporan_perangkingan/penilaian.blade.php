@extends("la.layouts.app")

@section("contentheader_title", "Hasil Penilaian Supplier")
@section("contentheader_description", "")
@section("section", "Hasil Penilaian Supplier")
@section("sub_section", "")
@section("htmlheader_title", "Hasil Penilaian Supplier")

@section("headerElems")
    <a id="btn-cetak" style="text-align:center;" data-id="6" data-button="show" class="btn btn-warning btn-sm">
        <i class="fa fa-print">&nbsp;Cetak Penilaian Supplier</i>
    </a>
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

<div class="content_penilaian">
<div class="box box-success">
    <div class="box-header">
        <div style="text-align: center;">
            <h3 class="box-title" style="font-weight: bold;">TABLE MATRIX KEPUTUSAN</h3>
        </div>
    </div>
    <div class="box-body">
        @include('flash::message')
        <div style="overflow-x: auto;">
        <table id="table-matrix-keputusan" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align" width="200px" rowspan="2">Nama Barang</th>
                    <th class="center-align" width="100px" rowspan="2">Tanggal</th>
                    <th class="center-align" width="100px" rowspan="1" colspan="5">Kriteria</th>
                </tr>
                <tr>
                    <th class="center-align">Harga</th>
                    <th class="center-align">Mutu</th>
                    <th class="center-align">Layanan</th>
                    <th class="center-align">Pembayaran</th>
                    <th class="center-align">Waktu</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>
<div class="box box-success">
    <div class="box-header">
        <div style="text-align: center;">
            <h3 class="box-title" style="font-weight: bold;">TABLE MATRIX KEPUTUSAN X</h3>
        </div>
    </div>
    <div class="box-body">
        @include('flash::message')
        <div style="overflow-x: auto;">
        <table id="table-matrix-keputusan-x" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align" width="200px" rowspan="2">Nama Barang</th>
                    <th class="center-align" width="100px" rowspan="2">Tanggal</th>
                    <th class="center-align" width="100px" rowspan="1" colspan="5">Kriteria</th>
                </tr>
                <tr>
                    <th class="center-align">Harga</th>
                    <th class="center-align">Mutu</th>
                    <th class="center-align">Layanan</th>
                    <th class="center-align">Pembayaran</th>
                    <th class="center-align">Waktu</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>
<div class="box box-success">
    <div class="box-header">
        <div style="text-align: center;">
            <h3 class="box-title" style="font-weight: bold;">TABLE MATRIX TERNORMALISASI R</h3>
        </div>
    </div>
    <div class="box-body">
        @include('flash::message')
        <div style="overflow-x: auto;">
        <table id="table-matrix-normalisasi-r" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align" width="200px" rowspan="2">Nama Barang</th>
                    <th class="center-align" width="100px" rowspan="2">Tanggal</th>
                    <th class="center-align" width="100px" rowspan="1" colspan="5">Kriteria</th>
                </tr>
                <tr>
                    <th class="center-align">Harga</th>
                    <th class="center-align">Mutu</th>
                    <th class="center-align">Layanan</th>
                    <th class="center-align">Pembayaran</th>
                    <th class="center-align">Waktu</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>
</div>
<div class="box-footer" style="margin-top: 50px;">
        <a href="{{ url(config('laraadmin.adminRoute')) }}" class="btn btn-warning">Menu Utama</a>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('la-assets/plugins/datatables/datatables.min.css')}}"/>
    <style type="text/css">
        .content_penilaian {
            background-color: white !important;
        }
    </style>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('la-assets/js/html2canvas.js') }}"></script>
<script src="{{ asset('la-assets/js/jspdf.debug.js') }}"></script>
<script>
$(function () {
    $("#table-matrix-keputusan").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables-matrix-keputusan', $id) }}",
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search"
        }
    });
    $("#employee-add-form").validate({
        
    });

    $("#table-matrix-keputusan-x").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables-matrix-keputusan-x', $id) }}",
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search"
        }
    });

    $("#table-matrix-normalisasi-r").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables-matrix-normalisasi-r', $id) }}",
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
        $('#AddModal').modal('show');
    })

    $('#btn-cetak').click(function () {   
         var pdf = new jsPDF('p', 'pt', 'letter');
         pdf.addHTML($('.content_penilaian')[0], function () {
             pdf.save('Penilaian_supplier.pdf');
         });
    });
});                 
</script>
@endpush