<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token()}}">

  <title>Food Receipe </title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('backendtemplate/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{asset('backendtemplate/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('backendtemplate/css/sb-admin.css')}}" rel="stylesheet">

  <link href="{{asset('css/user_form.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Sakura</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <!-- <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"> -->
        <div class="input-group-append">
          <!-- <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button> -->
        </div>
      </div>
    </form>

    <!-- Navbar -->
    @include('nav')

  <div id="wrapper">

    <!-- Sidebar -->
    @include('sidebar')

    <div id="content-wrapper">

      <div class="container-fluid">
        
        <!-- Breadcrumbs-->
        <!-- <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol> -->

        <!-- Icon Cards-->
        

        <!-- Area Chart Example-->
       
        <!-- DataTables Example -->
      
        @yield('content')

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('backendtemplate/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('backendtemplate/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('backendtemplate/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{asset('backendtemplate/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('backendtemplate/vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('backendtemplate/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('backendtemplate/js/sb-admin.min.js')}}"></script>

  <!-- Demo scripts for backendtemplate/this page-->
  <script src="{{asset('backendtemplate/js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('backendtemplate/js/demo/chart-area-demo.js')}}"></script>

  @yield('script')
</body>

</html>
