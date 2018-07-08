<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ url('/la-assets/img/user8-128x128.jpg') }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{Auth::user()->roles[0]->display_name}} </a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MODULES</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url(config('laraadmin.adminRoute')) }}"><i class='fa fa-home'></i> <span>Dashboard</span></a></li>
            <?php
            $menuItems = Dwij\Laraadmin\Models\Menu::where("parent", 0)->orderBy('hierarchy', 'asc')->get();
            ?>
            @foreach ($menuItems as $menu)
                @if($menu->type == "module")
                    <?php
                    $temp_module_obj = Module::get($menu->name);
                    ?>
                    @la_access($temp_module_obj->id)
						@if(isset($module->id) && $module->name == $menu->name)
                        	<?php echo LAHelper::print_menu($menu ,true); ?>
						@else
							<?php echo LAHelper::print_menu($menu); ?>
						@endif
                    @endla_access
                @else
                    <?php echo LAHelper::print_menu($menu); ?>
                @endif
            @endforeach
            <li><a href="{{route('admin-index-kriteria-penilaian')}}"><i class='fa fa-pencil-square-o'></i> <span>Kriteria Penilaian</span></a></li>
            <li><a href="{{route('admin-index-mengelola-supplier')}}"><i class='fa fa-tasks'></i> <span>Mengelola Supplier</span></a></li>
            <li><a href="{{route('admin-index-mengelola-barang')}}"><i class='fa fa-cubes'></i> <span>Mengelola Barang</span></a></li>
<!--             <li class="treeview">
                <a href="http://localhost:8000/admin/#">
                    <i class="fa fa-cubes"></i> 
                    <span>Mengelola Barang</span> 
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="http://localhost:8000/admin/users">
                            <i class="fa fa-plus"></i> 
                            <span>Tambah Barang</span> 
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost:8000/admin/departments">
                            <i class="fa fa-edit"></i> 
                            <span>Ubah Barang</span> 
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost:8000/admin/employees">
                            <i class="fa fa-trash-o"></i>
                            <span>Hapus Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost:8000/admin/roles">
                            <i class="fa fa-sort-amount-asc"></i>
                            <span>Daftar Barang</span> 
                        </a>
                    </li>
                </ul>
            </li> -->
            <li>
                <a href="{{route('admin-index-mengelola-penilaian-supplier')}}">
                    <i class='fa fa-tasks'></i> 
                    <span>Mengelola Penilaian Supplier</span>
                </a>
            </li>
            <li><a href="#"><i class='fa fa-line-chart'></i> <span>Laporan Perangkingan</span></a></li>
            <!-- LAMenus -->
            
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
