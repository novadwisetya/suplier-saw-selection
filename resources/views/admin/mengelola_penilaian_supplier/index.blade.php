@extends("la.layouts.app")

@section("contentheader_title", "Kelola Penilaian Supplier")
@section("contentheader_description", "Detail")
@section("section", "Kelola Penilaian Supplier")
@section("sub_section", "Detail")
@section("htmlheader_title", "Kelola Penilaian Supplier")

@section("headerElems")
   <!--  <button class="btn btn-success btn-sm pull-right" id="tambahPenilaian">Tambah Penilaian</button> -->

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
    {!! Form::open(array('url' => route('admin-store-penilaian-supplier'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-container', 'files'=>true)) !!}
    <div class="box-header">
        @include('flash::message')
        <div style="text-align: center;">
            
        </div>
        <div style="margin-top: 30px;">
            <div class="form-group row">
                <label class="col-sm-2 control-label">
                    No. PO
                    <span style="font-size:18px;color:red">*</span>
                </label>
                <div class="col-sm-4">
                    {!! Form::text('po_number', old('po_number'), ['id' => 'po_number', 'class' => 'form-control', 'placeholder' => 'No. PO', 'required']) !!}

                    @if ($errors->has('po_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('po_number') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="form-group row {{($errors->has('supplier_id')? 'has-error' : '')}}">
                <label class="col-sm-2 control-label">
                    Nama Supplier
                    <span style="font-size:18px;color:red">*</span>
                </label>
                <div class="col-sm-4">
                    {!! Form::select('suppliers_id', $data_supplier, null, ['id' => 'nama_supplier', 'class' => 'form-control', 'placeholder' => 'Pilih Supplier']) !!}

                    @if ($errors->has('suppliers_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('suppliers_id') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="form-group row {{($errors->has('tanggal')? 'has-error' : '')}}">
                <label class="col-sm-2 control-label">
                    Tanggal
                    <span style="font-size:18px;color:red">*</span>
                </label>
                <div class="col-sm-4">
                    {!! Form::date('tanggal', null, ['id' => 'tanggal', 'class' => 'form-control', 'placeholder' => 'Tanggal']) !!}

                    @if ($errors->has('tanggal'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tanggal') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
        </div>
    </div>
    <div class="box-body">
        @include('flash::message')
        <div style="overflow-x: auto;">
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align" style="min-width: 250px;" rowspan="2">Nama Barang</th>
                    <th class="center-align" style="min-width: 250px;" colspan="2">Kuantum</th>
                    <th class="center-align" style="min-width: 250px;" colspan="2">Harga</th>
                    <th class="center-align" style="min-width: 250px;" rowspan="2">Mutu</th>
                    <th class="center-align" style="min-width: 250px;" rowspan="2">Layanan</th>
                    <th class="center-align" style="min-width: 250px;" rowspan="2">Pembayaran</th>
                    <th class="center-align" style="min-width: 250px;" rowspan="2">Waktu</th>
                    <th class="center-align" style="min-width: 80px;" rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th class="center-align">Drum</th>
                    <th class="center-align">Kg</th>
                    <th class="center-align">Satuan</th>
                    <th class="center-align">Jumlah</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr>
                    <td class="center-align">
                        <div class="col-sm-12">
                            <select class="form-control bottom-border select-barang" name="penilaian[1][products_id]">
                                <option value="">Pilih Barang</option>
                            </select>
                        </div> 
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('penilaian[1][drum]', null, ['id' => 'drum', 'class' => 'form-control bottom-border', 'placeholder' => 'Drum', 'step' => '.01', 'min' => '0.01', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('penilaian[1][kg]', null, ['id' => 'kg', 'class' => 'form-control bottom-border', 'placeholder' => 'Kg', 'step' => '.01', 'min' => '0.01', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('penilaian[1][satuan]', null, ['id' => 'satuan', 'class' => 'form-control bottom-border', 'placeholder' => 'Satuan', 'step' => '1', 'min' => '1', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::number('penilaian[1][jumlah]', null, ['id' => 'jumlah', 'class' => 'form-control bottom-border', 'placeholder' => 'Jumlah', 'step' => '1', 'min' => '1', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('penilaian[1][mutu]', $mutu, null, ['id' => 'mutu', 'class' => 'form-control bottom-border select-mutu', 'placeholder' => 'Pilih Mutu', 'required']) !!}
                        </div> 
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('penilaian[1][layanan]', $layanan, null, ['id' => 'layanan', 'class' => 'form-control bottom-border select-layanan', 'placeholder' => 'Pilih Layanan', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('penilaian[1][pembayaran]', $pembayaran, null, ['id' => 'pembayaran', 'class' => 'form-control bottom-border select-pembayaran', 'placeholder' => 'Pilih Pembayaran', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <div class="col-sm-12">
                            {!! Form::select('penilaian[1][waktu]', $waktu, null, ['id' => 'waktu', 'class' => 'form-control bottom-border select-waktu', 'placeholder' => 'Pilih Waktu', 'required']) !!}
                        </div>
                    </td>
                    <td class="center-align">
                        <a style="text-align:center;" class="btn btn-success btn-xs tambahPenilaian">
                            <i class="fa fa-plus"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{ url(config('laraadmin.adminRoute')) }}" class="btn btn-warning">Menu Utama</a>
        <input class="btn btn-primary pull-right" title="Simpan" type="submit" value="simpan" id="button_submit">
    </div>
    {!! Form::close() !!}
</div>

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('la-assets/plugins/datatables/datatables.min.css')}}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script> 
    $(document).on('change', '#nama_supplier',function(){
        var supplier_id = $(this).val();
        var url = "{{route('ajax-get-data-barang', ':id')}}";
        url = url.replace(':id', supplier_id);

        $.get(url, function(data, status){
            var option = '';
            if(data.data != ''){
                $.each(data.data, function(key, value) {
                    option += '<option value="'+key+'">'+value+'</option>';
                });
            }else{
                option += '<option value="">Tidak ada barang<option>';
            }

            $('.select-barang').html(option);
        });
    });

    $(document).on('click', '.tambahPenilaian', function(){

        var index = Math.random().toString(36).substring(2);
        var optioBarang = $('.select-barang').html();
        var optionMutu = $('.select-mutu').html();
        var optionLayanan = $('.select-layanan').html();
        var optionPembayaran = $('.select-pembayaran').html();
        var optionWaktu = $('.select-waktu').html();
        var produtsId = 'products_id';
        var drum = 'drum';
        var kg = 'kg';
        var satuan = 'satuan';
        var jumlah = 'jumlah';
        var mutu = 'mutu';
        var layanan = 'layanan';
        var pembayaran = 'pembayaran';
        var waktu = 'waktu';

        var html = '<tr id="tr-'+index+'" class="animated bounceInDown">'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select class="form-control bottom-border select-barang select-barang-'+index+'" name="penilaian['+index+']['+produtsId+']">'
                                    +optioBarang
                                +'</select>'
                            +'</div>' 
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input class="form-control bottom-border" placeholder="Drum" step=".01" min="0.01" required="" name="penilaian['+index+']['+drum+']" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input class="form-control bottom-border" placeholder="Kg" step=".01" min="0.01" required="" name="penilaian['+index+']['+kg+']" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input class="form-control bottom-border" placeholder="Satuan" step="1" min="1" required="" name="penilaian['+index+']['+satuan+']" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input class="form-control bottom-border" placeholder="Jumlah" step="1" min="1" required="" name="penilaian['+index+']['+jumlah+']" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select class="form-control bottom-border" required="" name="penilaian['+index+']['+mutu+']">'
                                    +optionMutu
                                +'</select>'
                            +'</div>' 
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select id="layanan" class="form-control bottom-border" required="" name="penilaian['+index+']['+layanan+']">'
                                    +optionLayanan
                                +'</select>'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select id="pembayaran" class="form-control bottom-border" required="" name="penilaian['+index+']['+pembayaran+']">'
                                    +optionPembayaran
                                +'</select>'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select id="waktu" class="form-control bottom-border" required="" name="penilaian['+index+']['+waktu+']">'
                                    +optionWaktu
                                +'</select>'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<a style="text-align:center;" class="btn btn-success btn-xs tambahPenilaian">'
                                +'<i class="fa fa-plus"></i>'
                            +'</a>&nbsp'
                            +'<a style="text-align:center;" class="btn btn-danger btn-xs delete-btn" data-index="'+index+'"><i class="fa fa-trash"></i></a>'
                        +'</td>'
                    +'</tr>';

        $('#table-body').append(html);


    });

    $(document).on('click', '.delete-btn', function(){
        var index = $(this).data('index');
        $('#tr-' + index).remove();
    });

</script>
@endpush