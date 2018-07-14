@extends("la.layouts.app")

@section("contentheader_title", "Mengelola Supplier")
@section("contentheader_description", "Import")
@section("section", "Mengelola Supplier")
@section("sub_section", "Import")
@section("htmlheader_title", "Mengelola Supplier")

@section("headerElems")

@endsection

@section("main-content")
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <div style="text-align: center;">
                    <h3 class="box-title" style="font-weight: bold;">IMPORT SUPPLIER</h3>
                </div>
            </div>
            <legend></legend>
            {!! Form::open(array('url' => route('admin-import-tambah-supplier'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-container', 'files'=>true)) !!}
                <div class="box-body">
                @include('flash::message')
                    <div class="form-group row {{($errors->has('import')? 'has-error' : '')}}">
                        <label class="col-sm-2 col-sm-offset-2 control-label">
                            Inport Supplier
                            <span style="font-size:18px;color:red">*</span>
                        </label>
                        <div class="col-sm-4">
                            {!! Form::file('import', old('import'), ['id' => 'import', 'class' => 'form-control']) !!}
                            @if ($errors->has('import'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('import') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                </div>
                <div class="box-footer">
                    <a href="#" class="btn btn-danger">Cancel</a>
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