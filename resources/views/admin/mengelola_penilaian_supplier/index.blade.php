@extends("la.layouts.app")

@section("contentheader_title", "Kriteria Penilaian")
@section("contentheader_description", "Detail")
@section("section", "Kriteria Penilaian")
@section("sub_section", "Detail")
@section("htmlheader_title", "Kriteria Penilaian")

@section("headerElems")
@la_access("Employees", "create")
    <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Tambah Sub Kriteria</button>
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
            <h3 class="box-title" style="font-weight: bold;">MENU MENGELOLA PENILAIAN SUPPLIER</h3>
        </div>
        <div style="margin-top: 30px;">
            <div class="form-group row">
                <label class="col-sm-2 control-label">
                    No. PO
                    <span style="font-size:18px;color:red">*</span>
                </label>
                <div class="col-sm-4">
                    {!! Form::text('purchasing_order', old('purchasing_order'), ['id' => 'purchasing_order', 'class' => 'form-control', 'placeholder' => 'No. PO', 'required']) !!}

                    @if ($errors->has('purchasing_order'))
                        <span class="help-block">
                            <strong>{{ $errors->first('purchasing_order') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="form-group row {{($errors->has('nama_supplier')? 'has-error' : '')}}">
                <label class="col-sm-2 control-label">
                    Nama Supplier
                    <span style="font-size:18px;color:red">*</span>
                </label>
                <div class="col-sm-4">
                    {!! Form::select('nama_supplier', $data_supplier, null, ['id' => 'nama_supplier', 'class' => 'form-control', 'placeholder' => 'Pilih Supplier']) !!}

                    @if ($errors->has('nama_supplier'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama_supplier') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="form-group row {{($errors->has('nama_supplier')? 'has-error' : '')}}">
                <label class="col-sm-2 control-label">
                    Tanggal
                    <span style="font-size:18px;color:red">*</span>
                </label>
                <div class="col-sm-4">
                    {!! Form::date('name', null, ['id' => 'tanggal', 'class' => 'form-control', 'placeholder' => 'Pilih Supplier']) !!}

                    @if ($errors->has('nama_supplier'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama_supplier') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
        </div>
    </div>
    <div class="box-body">
        @include('flash::message')
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align" width="20%" rowspan="2">Nama Barang</th>
                    <th class="center-align" width="30%" colspan="2">Kuantum</th>
                    <th class="center-align" width="30%" colspan="2">Harga</th>
                    <th class="center-align" width="10%" rowspan="2">Mutu</th>
                    <th class="center-align" width="10%" rowspan="2">Layanan</th>
                    <th class="center-align" width="10%" rowspan="2">Pembayaran</th>
                    <th class="center-align" width="10%" rowspan="2">Waktu</th>
                </tr>
                <tr>
                    <th class="center-align">Drum</th>
                    <th class="center-align">Kg</th>
                    <th class="center-align">Satuan</th>
                    <th class="center-align">Jumlah</th>
                </tr>
                <tr>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::text('nama_barang', old('nama_barang'), ['id' => 'nama_barang', 'class' => 'form-control bottom-border', 'placeholder' => 'Nama Barang']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('drum', null, ['id' => 'drum', 'class' => 'form-control bottom-border', 'placeholder' => 'Drum', 'step' => '.01', 'min' => '0.01', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('kg', null, ['id' => 'kg', 'class' => 'form-control bottom-border', 'placeholder' => 'Kg', 'step' => '.01', 'min' => '0.01', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('satuan', null, ['id' => 'satuan', 'class' => 'form-control bottom-border', 'placeholder' => 'Satuan', 'step' => '1', 'min' => '1', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('jumlah', null, ['id' => 'jumlah', 'class' => 'form-control bottom-border', 'placeholder' => 'Jumlah', 'step' => '1', 'min' => '1', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('mutu', [], null, ['id' => 'mutu', 'class' => 'form-control bottom-border', 'placeholder' => 'Pilih Mutu', 'required']) !!}
                        </div> 
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('layanan', [], null, ['id' => 'layanan', 'class' => 'form-control bottom-border', 'placeholder' => 'Pilih Layanan', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('pembayaran', [], null, ['id' => 'pembayaran', 'class' => 'form-control bottom-border', 'placeholder' => 'Pilih Pembayaran', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('waktu', [], null, ['id' => 'waktu', 'class' => 'form-control bottom-border', 'placeholder' => 'Pilih Waktu', 'required']) !!}
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>

@la_access("Employees", "create")
@endla_access

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('la-assets/plugins/datatables/datatables.min.css')}}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>                 
</script>
@endpush