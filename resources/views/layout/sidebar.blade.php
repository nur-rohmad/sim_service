<aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                                <!-- User Profile-->
                                <li class="sidebar-item"> <a
                                                class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('dashboard') ? 'active' : '' ; }}"
                                                href="/dashboard" aria-expanded="false"><i
                                                        class="me-3 far fa-clock fa-fw" aria-hidden="true"></i><span
                                                        class="hide-menu">Dashboard</span></a></li>
                                <li class="sidebar-item"> <a
                                                class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('service') ? 'active' : ''  }}"
                                                href="/service" aria-expanded="false">
                                                <i class="me-3 fas fa-wrench" aria-hidden="true"></i><span
                                                        class="hide-menu">Service</span></a>
                                </li>
                                <li class="sidebar-item"> <a
                                                class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('barang') ? 'active' : ''  }}"
                                                href="/barang" aria-expanded="false">
                                                <i class="me-3 fas fa-boxes" aria-hidden="true"></i><span
                                                        class="hide-menu">Barang</span></a>
                                </li>
                                <li class="sidebar-item"> <a
                                                class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('report') ? 'active' : ''  }}"
                                                href="/report" aria-expanded="false">
                                                <i class="me-3 fas fa-file" aria-hidden="true"></i><span
                                                        class="hide-menu">Laporan</span></a>
                                </li>


                </nav>
                <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
</aside>