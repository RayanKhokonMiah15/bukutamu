<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            overflow-x: hidden;
        }
        
        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            margin-left: -250px;
            background-color: #f8f9fa;
            transition: margin 0.25s ease-out;
            position: fixed;
            z-index: 1000;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            color: #007bff;
            background-color: #e9ecef;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }

        #page-content-wrapper {
            min-width: calc(100vw - 250px);
            margin-left: 250px;
            transition: margin 0.25s ease-out;
            position: relative;
        }

        .navbar {
            padding: 0.75rem 1rem;
            background-color: white;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            z-index: 1030;
            transition: left 0.25s ease-out;
        }

        #menu-toggle {
            cursor: pointer;
            padding: 0.25rem 0.75rem;
            font-size: 1.25rem;
            background: none;
            border: none;
            color: #333;
        }

        #menu-toggle:hover {
            color: #007bff;
        }

        /* When sidebar is hidden */
        #wrapper:not(.toggled) {
            #page-content-wrapper {
                margin-left: 0;
                min-width: 100vw;
            }
            .navbar {
                left: 0;
            }
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -250px;
            }
            
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                margin-left: 0;
                min-width: 100vw;
            }

            .navbar {
                left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar">
                <div class="pt-4">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar"></i>
                                Statistik Tamu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar"></i>
                                Laporan Harian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog"></i>
                                Pengaturan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container-fluid">
                    <button id="menu-toggle" class="me-2">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-book me-2"></i> Buku Tamu
                    </a>
                </div>
            </nav>

            <div class="container-fluid" style="padding-top: 4.5rem;">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("wrapper").classList.toggle("toggled");
            document.body.classList.toggle("sidebar-shown");
        });
    </script>
</body>
</html>
