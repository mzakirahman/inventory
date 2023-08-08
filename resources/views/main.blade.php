<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <link href="{{ asset('/fontawesome/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $web['title'] }} - Inventory</title>
    <style>
        .select2-container .select2-selection__arrow {
            display: none;
        }
    </style>
</head>

<body>

    <div class="screen-cover d-none d-xl-none"></div>

    <div class="row">
        <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">

            <aside class="sidebar">
                <a href="#" class="sidebar-logo">
                    <div class="text-center" style="color: #000">
                        <p class="m-0 fw-bold" style="font-size:20px">PT Imbang Tata Alam</p>
                        <p class="m-0">Warehouse</p>
                        <img src="{{ asset(Auth::user()->foto) }}" alt="" style="width: 100px">
                        <p class="m-0">{{ Auth::user()->nama_user }}</p>
                        <p class="m-0 text-muted">Anda Adalah {{ get_role(Auth::user()->role) }}</p>
                    </div>
                    <button id="toggle-navbar" onclick="toggleNavbar()">
                        <img src="{{ asset('/assets/img/global/navbar-times.svg') }}" alt="">
                    </button>
                </a>

                <h5 class="sidebar-title">Menu</h5>
                <a href="{{ route('dashboard') }}" class="sidebar-item @if ($web['page'] == 'dashboard') active @endif">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9 22V12H15V22" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
                @if (Auth::user()->role == '1')
                <a href="{{ route('data-pengguna') }}"
                    class="sidebar-item @if ($web['page'] == 'pengguna') active @endif">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Data Pengguna</span>
                </a>
                @endif

                @if (Auth::user()->role == '1' || Auth::user()->role == '2')
                <?php $master_arr = ['suplier','stok'] ?>
                <a href="javascript:;"
                    class="sidebar-item dropdown-btn @if (in_array($web['page'],$master_arr)) active @endif">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21 16V8C20.9996 7.64927 20.9071 7.30481 20.7315 7.00116C20.556 6.69751 20.3037 6.44536 20 6.27L13 2.27C12.696 2.09446 12.3511 2.00205 12 2.00205C11.6489 2.00205 11.304 2.09446 11 2.27L4 6.27C3.69626 6.44536 3.44398 6.69751 3.26846 7.00116C3.09294 7.30481 3.00036 7.64927 3 8V16C3.00036 16.3507 3.09294 16.6952 3.26846 16.9988C3.44398 17.3025 3.69626 17.5546 4 17.73L11 21.73C11.304 21.9055 11.6489 21.9979 12 21.9979C12.3511 21.9979 12.696 21.9055 13 21.73L20 17.73C20.3037 17.5546 20.556 17.3025 20.7315 16.9988C20.9071 16.6952 20.9996 16.3507 21 16Z"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M3.27002 6.96L12 12.01L20.73 6.96" stroke="#ABB3C4" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 22.08V12" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>Data Master</span>
                    <i class="fas fa-chevron-down ms-auto text-muted"></i>

                </a>
                <div class="dropdown-container @if (in_array($web['page'],$master_arr))open @endif">
                    <a href="{{ route('data-suplier') }}"
                        class="subitem @if ($web['page'] == 'suplier')active @endif"><i class="far fa-circle me-4"
                            style="color: #ABB3C4"></i>Data Suplier</a>
                    <a href="{{ route('stok-barang') }}" class="subitem @if ($web['page'] == 'stok')active @endif"><i
                            class="far fa-circle me-4" style="color: #ABB3C4"></i>Stok Barang</a>
                </div>
                @endif

                @if (Auth::user()->role == '1' || Auth::user()->role == '2' || Auth::user()->role == '3')
                <?php $transaksi_arr = ['transaksi_masuk','transaksi_keluar'] ?>
                <a href="javascript:;"
                    class="sidebar-item dropdown-btn @if (in_array($web['page'],$transaksi_arr)) active @endif">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span>Transaksi</span>
                    <i class="fas fa-chevron-down ms-auto text-muted"></i>

                </a>
                <div class="dropdown-container @if (in_array($web['page'],$transaksi_arr))open @endif">
                    <a href="{{ route('transaksi-masuk') }}"
                        class="subitem @if ($web['page'] == 'transaksi_masuk')active @endif"><i
                            class="far fa-circle me-4" style="color: #ABB3C4"></i>Transaksi Barang Masuk</a>
                    <a href="{{ route('transaksi-keluar') }}"
                        class="subitem @if ($web['page'] == 'transaksi_keluar')active @endif"><i
                            class="far fa-circle me-4" style="color: #ABB3C4"></i>Transaksi Barang Keluar</a>
                </div>
                @endif

                @if (Auth::user()->role == '1'|| Auth::user()->role == '4' )
                <?php $laporan_arr = ['laporan_masuk','laporan_keluar','laporan_stok','laporan_suplier'] ?>
                <a href="javascript:;"
                    class="sidebar-item dropdown-btn @if (in_array($web['page'],$laporan_arr)) active @endif">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>Laporan</span>
                    <i class="fas fa-chevron-down ms-auto text-muted"></i>

                </a>
                <div class="dropdown-container @if (in_array($web['page'],$laporan_arr))open @endif">
                    <a href="{{ route('laporan-stok') }}"
                        class="subitem @if ($web['page'] == 'laporan_stok')active @endif"><i class="far fa-circle me-4"
                            style="color: #ABB3C4"></i>Laporan Stok Barang</a>
                    <a href="{{ route('laporan-suplier') }}"
                        class="subitem @if ($web['page'] == 'laporan_suplier')active @endif"><i
                            class="far fa-circle me-4" style="color: #ABB3C4"></i>Laporan Suplier</a>
                    <a href="{{ route('laporan-barang-masuk') }}"
                        class="subitem @if ($web['page'] == 'laporan_masuk')active @endif"><i class="far fa-circle me-4"
                            style="color: #ABB3C4"></i>Laporan Barang Masuk</a>
                    <a href="{{ route('laporan-barang-keluar') }}"
                        class="subitem @if ($web['page'] == 'laporan_keluar')active @endif"><i
                            class="far fa-circle me-4" style="color: #ABB3C4"></i>Laporan Barang Keluar</a>
                </div>
                @endif

                <a href="{{ route('logout') }}" class="sidebar-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 17L21 12L16 7" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M21 12H9" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span>Logout</span>
                </a>

            </aside>

        </div>


        <div class="col-12 col-xl-9">
            <div class="nav">
                <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
                    <div class="d-flex justify-content-start align-items-center">
                        <button id="toggle-navbar" onclick="toggleNavbar()">
                            <img src="{{ asset('/assets/img/global/burger.svg') }}" class="mb-2" alt="">
                        </button>
                        <h2 class="nav-title">{{ $web['title'] }}</h2>
                    </div>
                </div>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="{{ asset('/alert/package/dist/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('/jquery/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>


    <script>
        const navbar = document.querySelector('.col-navbar')
        const cover = document.querySelector('.screen-cover')
        const sidebar_items = document.querySelectorAll('.sidebar-item')

        function toggleNavbar() {
            navbar.classList.toggle('d-none')
            cover.classList.toggle('d-none')
        }
        
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }


    </script>
    @stack('js_function')
    @if (session()->has('accessError'))
    <script>
        Swal.fire("Warning", "{{ session('accessError') }}", "error");
    </script>
    @endif
</body>

</html>