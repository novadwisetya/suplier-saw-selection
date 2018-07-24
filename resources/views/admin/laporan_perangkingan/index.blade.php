@extends("la.layouts.app")

@section("contentheader_title", "Laporan Perangkingan")
@section("contentheader_description", "Detail")
@section("section", "Laporan Perangkingan")
@section("sub_section", "Detail")
@section("htmlheader_title", "Laporan Perangkingan")

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
    {{ csrf_field() }}
    <div class="box-header">
        <div style="text-align: center;">
        <div class="pull-right">
            <a id="btn-cetak" style="text-align:center;" data-id="6" data-button="show" class="btn btn-warning btn-sm">
                <i class="fa fa-print">&nbsp;Cetak Laporan Perangkingan</i>
            </a>
        </div>
        </div>
        <div style="margin-top: 30px;">
            <div class="form-group row">
                <label class="col-sm-2 control-label">
                    Bulan
                </label>
                <div class="col-sm-4">
                    {!! Form::select('bulan', ['1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'], null, ['id' => 'bulan', 'class' => 'form-control', 'placeholder' => 'Bulan']) !!}

                    @if ($errors->has('bulan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('bulan') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label">
                    Tahun
                </label>
                <div class="col-sm-4">
                <select name="tahun" class="form-control" id="tahun">
                    <option value="">Tahun</option>
                    <?php
                    $thn_skr = date('Y');
                    for ($x = $thn_skr; $x >= 2000; $x--) {
                    ?>
                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                    <?php
                    }
                    ?>
                </select>

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
                <input class="btn btn-primary" title="Cari" type="submit" value="cari" id="button_search" style="margin-left: 473px;">
            </div>

        </div>
    </div>
    {!! Form::close() !!}
    <div class="box-body">
        @include('flash::message')
        <table id="table-container" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align" style="min-width: 50px;">Id</th>
                    <th class="center-align" style="min-width: 100px;">Kode Supplier</th>
                    <th class="center-align" style="min-width: 300px;">Nama Supplier</th>
                    <th class="center-align" style="min-width: 250px;">Point</th>
                    <th class="center-align" style="min-width: 100px;" >Peringkat</th>
                </tr>
            </thead>
            <tbody id="body-table">
                <tr>
                    <td style="text-align:center;" colspan="5">Data tidak tersedia</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <a href="{{ url(config('laraadmin.adminRoute')) }}" class="btn btn-warning">Menu Utama</a>
    </div>

</div>
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('la-assets/plugins/datatables/datatables.min.css')}}"/>
    <style type="text/css">
        body{
            background-color: white !important;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr{
            background-color: white;
        }
    </style>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('la-assets/js/html2canvas.js') }}"></script>
<script src="{{ asset('la-assets/js/jspdf.debug.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#button_search', function(event){
            event.preventDefault();
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var kategori_barang = $('#kategori_barang').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ route('cari-laporan-perangkingan') }}",
                type: "post",
                dataType: 'json',
                data:{
                    _token : _token,
                    'bulan':bulan,
                    'tahun':tahun,
                    'kategori_barang':kategori_barang
                },
                success: function (response) {
                    var i = 1;
                    var panel = '';

                    console.log(jQuery.isEmptyObject(response.data));
                    if(jQuery.isEmptyObject(response.data)){
                        panel += '<tr>'
                            +'<td style="text-align:center;" colspan="5">Data tidak tersedia</td>'
                          +'</tr>';
                    }else{
                        $.each(response.data, function( index, value ) {
                        panel += '<tr>'
                            +'<td>'+i+'</td>'
                            +'<td>'+value.kode_supplier+'</td>'
                            +'<td>'+value.nama_supplier+'</td>'
                            +'<td>'+value.point+'</td>'
                            +'<td>'+i+'</td>'
                          +'</tr>';
                          i++;

                        });
                    }
                    
                    $('#body-table').html(panel);
                },
                error: function(response){
                }
            }); 
        });

    }); 



    $('#btn-cetak').click(function () {   
         var pdf = new jsPDF('p', 'pt', 'letter');
         pdf.addHTML($('#table-container')[0], function () {
             pdf.save('Laporan_perangkingan.pdf');
         });
    });
</script>
@endpush