<!doctype html>
<html lang="en">
<head>
    @include('partialsAdmin.head')
</head>
<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('partialsAdmin.sidebar')


        <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          @include('partialsAdmin.nav-admin')

          <!-- Begin Page Content -->
          <div class="container-fluid">

                @yield('content')

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        @include('partialsAdmin.footer-admin')

      </div>
      <!-- End of Content Wrapper -->


    @include('partialsAdmin.logout-model')
    </div>
  <!-- End of Page Wrapper -->

    @include('partialsAdmin.js')
</body>
</html>