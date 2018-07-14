@extends("la.layouts.app")

@section("contentheader_title", "Laporan Perangkingan")
@section("contentheader_description", "Detail")
@section("section", "Laporan Perangkingan")
@section("sub_section", "Detail")
@section("htmlheader_title", "Laporan Perangkingan")

@section("headerElems")
@la_access("Employees", "create")
   <!--  <button class="btn btn-success btn-sm pull-right" id="tambahPenilaian">Tambah Penilaian</button> -->
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
    {!! Form::open(array('url' => route('admin-store-penilaian-supplier'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-container', 'files'=>true)) !!}
    <div class="box-header">
        <div style="text-align: center;">
            <h3 class="box-title" style="font-weight: bold;">LAPORAN PERANGKINGAN</h3>
        </div>
        <div style="margin-top: 30px;">
            <div class="form-group row">
                <label class="col-sm-2 control-label">
                    Bulan
                </label>
                <div class="col-sm-4">
                    {!! Form::text('bulan', old('bulan'), ['id' => 'bulan', 'class' => 'form-control', 'placeholder' => 'Bulan', 'required']) !!}

                    @if ($errors->has('bulan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('bulan') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="form-group row {{($errors->has('tahun')? 'has-error' : '')}}">
                <label class="col-sm-2 control-label">
                    Tahun
                </label>
                <div class="col-sm-4">
                     {!! Form::text('tahun', old('tahun'), ['id' => 'tahun', 'class' => 'form-control', 'placeholder' => 'Tahun', 'required']) !!}

                    @if ($errors->has('tahun'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tahun') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="form-group row {{($errors->has('kategori_barang')? 'has-error' : '')}}">
                <label class="col-sm-2 control-label">
                    Kategori Barang
                </label>
                <div class="col-sm-4">
                    {!! Form::select('kategori_barang', $kategori_barang, null, ['id' => 'kategori_barang', 'class' => 'form-control', 'placeholder' => 'Pilih Kategori Barang', 'required']) !!}

                    @if ($errors->has('kategori_barang'))
                        <span class="help-block">
                            <strong>{{ $errors->first('kategori_barang') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div>
                <input class="btn btn-primary" title="Cari" type="submit" value="cari" id="button_submit" style="margin-left: 473px;">
            </div>

        </div>
    </div>
    <div class="box-body">
        @include('flash::message')
        <div style="overflow-x: auto;">
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align" style="min-width: 250px;">Kode Supplier</th>
                    <th class="center-align" style="min-width: 250px;">Nama Supplier</th>
                    <th class="center-align" style="min-width: 250px;">Point</th>
                    <th class="center-align" style="min-width: 250px;" >Peringkat</th>
                </tr>
            </thead>
            <tbody id="table-body">
            @foreach($supplier as $key => $value)
                <tr>
                    <td class="center-align" style="min-width: 250px;" >{{$value->kode_supplier}}</td>
                    <td class="center-align" style="min-width: 250px;">{{$value->nama_supplier}}</td>
                    <td class="center-align" style="min-width: 250px;">0.89</td>
                    <td class="center-align" style="min-width: 250px;">{{$value->id}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    {!! Form::close() !!}
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

        var html = '<tr id="tr-'+index+'" class="animated bounceInDown">'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select class="form-control bottom-border select-barang select-barang-'+index+'" name="nama_barang">'
                                    +optioBarang
                                +'</select>'
                            +'</div>' 
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input id="drum" class="form-control bottom-border" placeholder="Drum" step=".01" min="0.01" required="" name="drum" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input id="kg" class="form-control bottom-border" placeholder="Kg" step=".01" min="0.01" required="" name="kg" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input id="satuan" class="form-control bottom-border" placeholder="Satuan" step="1" min="1" required="" name="satuan" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<input id="jumlah" class="form-control bottom-border" placeholder="Jumlah" step="1" min="1" required="" name="jumlah" type="number">'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select id="mutu" class="form-control bottom-border" required="" name="mutu">'
                                    +optionMutu
                                +'</select>'
                            +'</div>' 
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select id="layanan" class="form-control bottom-border" required="" name="layanan">'
                                    +optionLayanan
                                +'</select>'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select id="pembayaran" class="form-control bottom-border" required="" name="pembayaran">'
                                    +optionPembayaran
                                +'</select>'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<div class="col-sm-12">'
                                +'<select id="waktu" class="form-control bottom-border" required="" name="waktu">'
                                    +optionWaktu
                                +'</select>'
                            +'</div>'
                        +'</td>'
                        +'<td class="center-align">'
                            +'<a style="text-align:center;" class="btn btn-success btn-xs tambahPenilaian">'
                                +'<i class="fa fa-plus"></i>'
                            +'</a>&nbsp'
                            +'<a style="text-align:center;" class="btn btn-danger btn-xs delete-btn" data-index="'+index+'"><i class="fa fa-close"></i></a>'
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