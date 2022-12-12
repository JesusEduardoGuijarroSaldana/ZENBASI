<?php
session_start();
if(isset($_POST['logout']))
{
 unset($_SESSION['user']);
 session_destroy();
 header('Location: ../loginTodos.html');
}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Inicio</title>
    
  <!-- theme meta -->
  <meta name="theme-name" content="mono" />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="../../theme/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="../../theme/plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="../../theme/plugins/nprogress/nprogress.css" rel="stylesheet" />
  
  <link href="../../theme/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />
  
  <link href="../../theme/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  
  <link href="../../theme/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
  
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  
  <link href="../../theme/plugins/toaster/toastr.min.css" rel="stylesheet" />
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="../../theme/css/style.css" />

 <!-- ICONO DE LA BARRA -->
 <link href="../../TODO/img/logo2.png" rel="shortcut icon" />


  <script src="../../theme/plugins/nprogress/nprogress.js"></script>
</head>

  <body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <div id="toaster"></div>
    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
      <!-- ====================================
          ——— BARRA LATERAL DEFINITIVA
        ===================================== -->
        <aside class="left-sidebar sidebar-light" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="indexAdmin.html">
                <img src="../img/logo2.png" width="40px" alt="ZENbasi">
                <span class="brand-name">ZENbasi</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
      
                <li class="active"
                 
                 >
                  <a class="sidenav-item-link" href="indexAdmin.php">
                    <i class="mdi mdi-home"></i>
                    <span class="nav-text">Inicio</span>
                  </a>
                </li>

                <li 
                 
                 >
                  <a class="sidenav-item-link" href="../../TODO/ADMIN/gruposAdmin.html">
                    <i class="mdi mdi-account-group"></i>
                    <span class="nav-text">Grupos</span>
                  </a>
                </li>

                <li 
                 
                >
                 <a class="sidenav-item-link" href="../../TODO/ADMIN/materiasAdmin.html">
                   <i class="mdi mdi-notebook"></i>
                   <span class="nav-text">Materias</span>
                 </a>
               </li>

               <li 
                 
               >
                <a class="sidenav-item-link" href="../../TODO/ADMIN/alumnosAdmin.html">
                  <i class="mdi mdi-account-box-multiple"></i>
                  <span class="nav-text">Alumnos</span>
                </a>
              </li>

              <li 
                 
              >
               <a class="sidenav-item-link" href="../../TODO/ADMIN/docentesAdmin.html">
                 <i class="mdi mdi-account-card-details"></i>
                 <span class="nav-text">Docentes</span>
               </a>
             </li>

             <li 
                 
              >
               <a class="sidenav-item-link" href="../../TODO/ADMIN/tutoresAdmin.html">
                 <i class="mdi mdi-account-supervisor-circle"></i>
                 <span class="nav-text">Tutores</span>
               </a>
             </li>
              
                

            </ul>
            </div>

            <div class="sidebar-footer">
                <ul class="nav sidebar-inner" id="sidebar-menu2">

                  <li>
                  <form method='post' >
                    
                    <button type="submit" name="logout" id="logout" class="btn btn-outline-primary btn-pill mb-4 ml-3"> <i class="mdi mdi-door-open mr-2"></i>Cerrar sesión</button>
                    </form>
                </li>
                </ul>
            </div>
          </div>
        </aside>

      

      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">
        
          <!-- Header -->
          <header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>

              <span class="page-title">ZENbasi</span>

              <div class="navbar-right ">

                

                <ul class="nav navbar-nav">
                  <img src="../../theme/images/user/user-xs-01.jpg" class="user-image rounded-circle mr-3" alt="User Image" />
                      <span class="d-none d-lg-inline-block">Bienvenido, <?php echo $_SESSION["user"]; ?></span>
                </ul>
              </div>
            </nav>


          </header>

        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content">                
            <div class="card card-default text-center">
              
              <div class="card-body">
                <div class="card mb-4 py-3"><!-- CENTRAR -->
                  <div class="card-body text-center">
                    
                    <img src="../img/logo.png" alt="logo">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- Footer -->
          <footer class="footer mt-auto">
            <div class="copyright bg-white">
              
            </div>
          </footer>
      </div>
    </div>
    
                    



    
                    <script src="../../theme/plugins/jquery/jquery.min.js"></script>
                    <script src="../../theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="../../theme/plugins/simplebar/simplebar.min.js"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

                    <script src="../../theme/plugins/apexcharts/apexcharts.js"></script>
                    
                    <script src="../../theme/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
                    
                    <script src="../../theme/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
                    <script src="../../theme/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
                    <script src="../../theme/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
                    
                    <script src="../../theme/plugins/daterangepicker/moment.min.js"></script>
                    <script src="../../theme/plugins/daterangepicker/daterangepicker.js"></script>
                    <script>
                      jQuery(document).ready(function() {
                        jQuery('input[name="dateRange"]').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        locale: {
                          cancelLabel: 'Clear'
                        }
                      });
                        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                          jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
                        });
                        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                          jQuery(this).val('');
                        });
                      });
                    </script>
                    
                    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                    
                    <script src="../../theme/plugins/toaster/toastr.min.js"></script>

                    <script src="../../theme/js/mono.js"></script>
                    <script src="../../theme/js/chart.js"></script>
                    <script src="../../theme/js/map.js"></script>
                    <script src="../../theme/js/custom.js"></script>

                    


                    <!--  -->


  </body>
</html>
