<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    @if(Auth::user()->gender == "Female")
                        <img src="{{ url('/la-assets/img/perempuan.png') }}" class="img-circle" alt="User Image" />
                    @else
                        <img src="{{ url('/la-assets/img/laki_laki.png') }}" class="img-circle" alt="User Image" />
                    @endif
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{(Auth::user()->role == 'manager') ? 'Manager' : 'Bagian Pembelian' }} </a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MODULES</li>
            <!-- Optionally, you can add icons to the links -->

            <li><a href="{{ url(config('laraadmin.adminRoute')) }}"><i class='fa fa-home'></i> <span>Menu Utama</span></a></li>

            @if(Auth::user()->role == 'bagian_pembelian')
                <li><a href="{{route('admin-index-mengelola-supplier')}}"><i class='fa fa-tasks'></i> <span>Kelola Data Supplier</span></a></li>
                <li><a href="{{route('admin-index-mengelola-barang')}}"><i class='fa fa-cubes'></i> <span>Kelola Data Barang</span></a></li>
                <li><a href="{{route('admin-index-mengelola-penilaian-supplier')}}"><i class='fa fa-tasks'></i> <span>Kelola Penilaian Supplier</span>
                    </a>
                </li>
                <li><a href="{{route('admin-index-laporan-perangkingan')}}"><i class='fa fa-line-chart'></i> <span>Laporan Perangkingan</span></a></li>
            @endif

            @if(Auth::user()->role == 'manager')
                <li><a href="/admin/employees"><i class='fa fa-user'></i> <span>Pengguna</span></a></li>
                <li><a href="{{route('admin-index-kriteria-penilaian')}}"><i class='fa fa-pencil-square-o'></i> <span>Kelola Kriteria Penilaian</span></a></li>
                <li><a href="{{route('admin-index-laporan-perangkingan')}}"><i class='fa fa-line-chart'></i> <span>Laporan Perangkingan</span></a></li>
            @endif

            <li><a href="{{route('admin-index-mengelola-supplier')}}"><i class='fa fa-tasks'></i> <span>Kelola Data Supplier</span></a></li>
                <li><a href="{{route('admin-index-mengelola-barang')}}"><i class='fa fa-cubes'></i> <span>Kelola Data Barang</span></a></li>
                <li><a href="{{route('admin-index-mengelola-penilaian-supplier')}}"><i class='fa fa-tasks'></i> <span>Kelola Penilaian Supplier</span>
                    </a>
                </li>
                <li><a href="{{route('admin-index-laporan-perangkingan')}}"><i class='fa fa-line-chart'></i> <span>Laporan Perangkingan</span></a></li>
            <!-- LAMenus -->
            
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
