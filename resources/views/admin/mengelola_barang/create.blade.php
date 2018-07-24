@extends("la.layouts.app")

@section("contentheader_title", "Kelola Data Barang")
@section("contentheader_description", "Tambah")
@section("section", "Kelola Data Barang")
@section("sub_section", "Tambah")
@section("htmlheader_title", "Kelola Data Barang")

@section("headerElems")

@endsection

@section("main-content")
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <div style="text-align: center;">
                    <h3 class="box-title" style="font-weight: bold;">TAMBAH DATA BARANG</h3>
                </div>
            </div>
            <legend></legend>
            {!! Form::open(array('url' => route('admin-store-tambah-barang'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-container', 'files'=>true)) !!}
                <div class="box-body">
                @include('flash::message')
                    <div class="form-group row {{($errors->has('kode_barang')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Kode Barang
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('kode_barang', old('kode_barang'), ['id' => 'kode_barang', 'class' => 'form-control', 'placeholder' => 'Kode Barang']) !!}

                            @if ($errors->has('kode_barang'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_barang') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('nama_barang')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Nama Barang
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('nama_barang', old('nama_barang'), ['id' => 'nama_barang', 'class' => 'form-control', 'placeholder' => 'Nama Barang']) !!}

                            @if ($errors->has('nama_barang'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama_barang') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                    <div class="form-group row {{($errors->has('kategori_barang')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Kategori Barang
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('kategori_barang', old('kategori_barang'), ['id' => 'kategori_barang', 'class' => 'form-control', 'placeholder' => 'Kategori Barang']) !!}

                            @if ($errors->has('kategori_barang'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kategori_barang') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                    <div class="form-group row {{($errors->has('jenis_barang')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Jenis Barang
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('jenis_barang', old('jenis_barang'), ['id' => 'jenis_barang', 'class' => 'form-control', 'placeholder' => 'Jenis Barang']) !!}

                            @if ($errors->has('jenis_barang'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jenis_barang') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                    <div class="form-group row {{($errors->has('suppliers_id')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Nama Supplier
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::select('suppliers_id', $data_supplier, null, ['id' => 'jenis_barang', 'class' => 'form-control', 'placeholder' => 'Pilih Supplier']) !!}

                            @if ($errors->has('jenis_barang'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jenis_barang') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{route('admin-index-mengelola-barang')}}" class="btn btn-danger">Batal</a>
                    <input class="btn btn-primary pull-right" title="Simpan" type="submit" value="simpan" id="button_submit">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>

</script>
@endpush