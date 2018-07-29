@extends('la.layouts.app')

@section('htmlheader_title') Menu Utama @endsection
@section('contentheader_title') Menu Utama @endsection
@section('contentheader_description')@endsection

@section('main-content')
        <section class="content">
          @if(Auth::user()->role == 'bagian_pembelian')
          <div class="row">
            <div class="col-lg-6">
              <div class="container col-lg-8 col-lg-offset-4">
                <div class="panel panel-default">
                  <div class="panel-body" style="height: 180px">
                    <a href="{{route('admin-index-mengelola-supplier')}}">
                        <img class="col-xs-8 col-md-offset-2" src="{{ url('/la-assets/img/tasks.png') }}">
                    </a>
                  </div>
                  <div class="panel-footer text-center dashboard-footer">
                      <a href="{{route('admin-index-mengelola-supplier')}}">Kelola Data Supplier</a> 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="container col-lg-8">
                <div class="panel panel-default">
                  <div class="panel-body" style="height: 180px">
                    <a href="{{route('admin-index-mengelola-barang')}}">
                        <img class="col-xs-8 col-md-offset-2" src="{{ url('/la-assets/img/cubes.png') }}">
                    </a>
                  </div>
                  <div class="panel-footer text-center dashboard-footer">
                      <a href="{{route('admin-index-mengelola-barang')}}">Kelola Data Barang</a> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="container col-lg-8 col-lg-offset-4">
                <div class="panel panel-default">
                  <div class="panel-body" style="height: 180px">
                    <a href="{{route('admin-index-mengelola-penilaian-supplier')}}">
                        <img class="col-xs-8 col-md-offset-2" src="{{ url('/la-assets/img/square.png') }}">
                    </a>
                  </div>
                  <div class="panel-footer text-center dashboard-footer">
                      <a href="{{route('admin-index-mengelola-penilaian-supplier')}}">Kelola Penilaian Supplier</a> 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="container col-lg-8">
                <div class="panel panel-default">
                  <div class="panel-body" style="height: 180px">
                    <a href="{{route('admin-index-laporan-perangkingan')}}">
                        <img class="col-xs-8 col-md-offset-2" src="{{ url('/la-assets/img/chart.png') }}">
                    </a>
                  </div>
                  <div class="panel-footer text-center dashboard-footer">
                      <a href="{{route('admin-index-laporan-perangkingan')}}">Laporan Perangkingan</a> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          @if(Auth::user()->role == 'manager')
          <div class="row">
            <div class="col-lg-6">
              <div class="container col-lg-8 col-lg-offset-4">
                <div class="panel panel-default">
                  <div class="panel-body" style="height: 180px">
                    <a href="{{route('admin-index-kriteria-penilaian')}}">
                        <img class="col-xs-8 col-md-offset-2" src="{{ url('/la-assets/img/editProperty.png') }}">
                    </a>
                  </div>
                  <div class="panel-footer text-center dashboard-footer">
                      <a href="{{route('admin-index-kriteria-penilaian')}}">Kelola Kriteria Penilaian</a> 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="container col-lg-8">
                <div class="panel panel-default">
                  <div class="panel-body" style="height: 180px">
                    <a href="{{route('admin-index-laporan-perangkingan')}}">
                        <img class="col-xs-8 col-md-offset-2" src="{{ url('/la-assets/img/chart.png') }}">
                    </a>
                  </div>
                  <div class="panel-footer text-center dashboard-footer">
                      <a href="{{route('admin-index-laporan-perangkingan')}}">Laporan Perangkingan</a> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </section>
@endsection

@push('styles')
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/morris/morris.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush


@push('scripts')
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('la-assets/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('la-assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('la-assets/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('la-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('la-assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('la-assets/plugins/fastclick/fastclick.js') }}"></script>
<!-- dashboard -->
<script src="{{ asset('la-assets/js/pages/dashboard.js') }}"></script>
@endpush

@push('scripts')
@endpush