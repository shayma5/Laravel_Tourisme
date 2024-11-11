<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Événements</title>
    <link rel="icon" href="{{ asset('assets2/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets2/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets2/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets2/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets2/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets2/css/demo.css') }}" />
    
    <!-- Inclusion de FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />

    <!-- Inclusion de FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

    <!-- Styles CSS personnalisés -->
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('assets2/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                </div>
                <ul class="nav nav-secondary">
                    <li class="nav-item active">
                        <a
                            data-bs-toggle="collapse"
                            href="#dashboard"
                            class="collapsed"
                            aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hotels') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Hotels</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-th-list"></i>
                            <p>Events</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ url('/event') }}">
                                        <span class="sub-item">Events</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/calendar') }}">
                                        <span class="sub-item">Events Calendar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/participation') }}">
                                        <span class="sub-item">Participations</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-th-list"></i>
                            <p>Sidebar Layouts</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="sidebar-style-2.html">
                                        <span class="sub-item">Sidebar Style 2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="icon-menu.html">
                                        <span class="sub-item">Icon Menu</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#forms">
                            <i class="fas fa-pen-square"></i>
                            <p>Forms</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="forms/forms.html">
                                        <span class="sub-item">Basic Form</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Tables</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="tables/tables.html">
                                        <span class="sub-item">Basic Table</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tables/datatables.html">
                                        <span class="sub-item">Datatables</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#maps">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Maps</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="maps">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="maps/googlemaps.html">
                                        <span class="sub-item">Google Maps</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="maps/jsvectormap.html">
                                        <span class="sub-item">Jsvectormap</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Charts</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="charts/charts.html">
                                        <span class="sub-item">Chart Js</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Sparkline</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="widgets.html">
                            <i class="fas fa-desktop"></i>
                            <p>Widgets</p>
                            <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../documentation/index.html">
                            <i class="fas fa-file"></i>
                            <p>Documentation</p>
                            <span class="badge badge-secondary">1</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#submenu">
                            <i class="fas fa-bars"></i>
                            <p>Menu Levels</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="submenu">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-bs-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Level 1</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-bs-toggle="collapse" href="#subnav2">
                                        <span class="sub-item">Level 1</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav2">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="sub-item">Level 1</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('assets2/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Messages
                                            <a href="#" class="small">Mark all as read</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets2/img/jm_denis.jpg') }}" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block"> How are you? </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets2/img/chadengle.jpg') }}" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Chad</span>
                                                        <span class="block"> Ok, Thanks! </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets2/img/mlane.jpg') }}" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jhon Doe</span>
                                                        <span class="block"> Ready for the meeting today... </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets2/img/talha.jpg') }}" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Talha</span>
                                                        <span class="block"> Hi, Apa Kabar? </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">4</span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Notifications
                                        </div>
                                    </li>
                                    <!-- Ajouter le contenu des notifications ici -->
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            @yield('content')

            <div class="container">
                <h2>Calendrier des Événements</h2>
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Script pour charger et afficher le calendrier -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            // Vérification si le div 'calendar' est trouvé
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',  // Vue par défaut en mois
                    events: '/evenements',  // URL pour charger les événements depuis l'API
                    locale: 'fr',  // Langue française
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    }
                });
                calendar.render();
            } else {
                console.error("Le div #calendar n'a pas été trouvé.");
            }
        });
    </script>
     <!--   Core JS Files   -->
     <script src="{{ asset('assets2/js/core/jquery-3.7.1.min.js') }}"></script>
     <script src="{{ asset('assets2/js/core/popper.min.js') }}"></script>
     <script src="{{ asset('assets2/js/core/bootstrap.min.js') }}"></script>
 
     <!-- jQuery Scrollbar -->
     <script src="{{ asset('assets2/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
 
     <!-- Chart JS -->
     <script src="{{ asset('assets2/js/plugin/chart.js/chart.min.js') }}"></script>
 
     <!-- jQuery Sparkline -->
     <script src="{{ asset('assets2/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
 
     <!-- Chart Circle -->
     <script src="{{ asset('assets2/js/plugin/chart-circle/circles.min.js') }}"></script>
 
     <!-- Datatables -->
     <script src="{{ asset('assets2/js/plugin/datatables/datatables.min.js') }}"></script>
 
     <!-- Bootstrap Notify -->
     <script src="{{ asset('assets2/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
 
     <!-- jQuery Vector Maps -->
     <script src="{{ asset('assets2/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
     <script src="{{ asset('assets2/js/plugin/jsvectormap/world.js') }}"></script>
 
     <!-- Sweet Alert -->
     <script src="{{ asset('assets2/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
 
     <!-- Kaiadmin JS -->
     <script src="{{ asset('assets2/js/kaiadmin.min.js') }}"></script>
 
     <!-- Kaiadmin DEMO methods, don't include it in your project! -->
     <script src="{{ asset('assets2/js/setting-demo.js') }}"></script>
     <script src="{{ asset('assets2/js/demo.js') }}"></script>
     <script>
         $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
             type: "line",
             height: "70",
             width: "100%",
             lineWidth: "2",
             lineColor: "#177dff",
             fillColor: "rgba(23, 125, 255, 0.14)",
         });
 
         $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
             type: "line",
             height: "70",
             width: "100%",
             lineWidth: "2",
             lineColor: "#f3545d",
             fillColor: "rgba(243, 84, 93, .14)",
         });
 
         $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
             type: "line",
             height: "70",
             width: "100%",
             lineWidth: "2",
             lineColor: "#ffa534",
             fillColor: "rgba(255, 165, 52, .14)",
         });
     </script>

</body>
</html>
