    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">KASIR KURNIA MUDA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('home') }}" class="d-block">IRSYAD FAUZAN</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">KELOLA</li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Product
                            <span class="right badge badge-danger">NEW</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Supplier
                            <span class="right badge badge-danger">NEW</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Category
                            <span class="right badge badge-danger">NEW</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('keuangan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-fire"></i>
                        <p>
                            Keuangan
                            <span class="right badge badge-danger">NEW</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">JUALAN</li>
                <li class="nav-item">
                    <a href="{{ route('pengeluaran.index') }}" class="nav-link">
                        <i class="fas fa-car nav-icon"></i>
                        <p>Pengeluaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pembelian.index') }}" class="nav-link">
                        <i class="fas fa-water nav-icon"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link">
                        <i class="fas fa-sun nav-icon"></i>
                        <p>penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>Kasir</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
