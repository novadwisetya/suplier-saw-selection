@extends("la.layouts.app")

@section("contentheader_title", "Kelola Data Supplier")
@section("contentheader_description", "Tambah")
@section("section", "Kelola Data Supplier")
@section("sub_section", "Tambah")
@section("htmlheader_title", "Kelola Data Supplier")

@section("headerElems")

@endsection

@section("main-content")
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <div style="text-align: center;">
                    <h3 class="box-title" style="font-weight: bold;">UBAH DATA SUPPLIER</h3>
                </div>
            </div>
            <legend></legend>
            {!! Form::open(array('url' => route('admin-update-mengelola-supplier', $data->id),'method'=>'POST','class'=>'form-horizontal','id'=>'form-container', 'files'=>true)) !!}
                <div class="box-body">
                @include('flash::message')
                    <div class="form-group row {{($errors->has('kode_supplier')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Kode Supplier
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('kode_supplier', (old('kode_supplier') ? old('kode_supplier') : $data->kode_supplier), ['id' => 'kode_supplier', 'class' => 'form-control', 'placeholder' => 'Kode Supplier', 'disabled']) !!}

                            @if ($errors->has('kode_supplier'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_supplier') }}</strong>
                                </span>
                            @endif
                        </div> 
                        
                    </div>
                    <div class="form-group row {{($errors->has('nama_supplier')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Nama Supplier
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('nama_supplier', (old('nama_supplier') ? old('nama_supplier') : $data->nama_supplier), ['id' => 'nama_supplier', 'class' => 'form-control', 'placeholder' => 'Nama Supplier']) !!}

                            @if ($errors->has('nama_supplier'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama_supplier') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('alamat')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Alamat
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('alamat', (old('alamat') ? old('alamat') : $data->alamat), ['id' => 'alamat', 'class' => 'form-control', 'placeholder' => 'Alamat']) !!}

                            @if ($errors->has('alamat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('phone')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            No. Telepon
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('phone', (old('phone') ? old('phone') : $data->phone), ['id' => 'alamat', 'class' => 'form-control number-only', 'placeholder' => 'No Telepon']) !!}

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row {{($errors->has('email')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Email
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::text('email', (old('email') ? old('email') : $data->email), ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'email']) !!}

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{route('admin-index-mengelola-penilaian-supplier')}}" class="btn btn-danger">Batal</a>
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