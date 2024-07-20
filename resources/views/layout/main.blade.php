<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  @include('layout.partials.head')
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('layout.partials.sidebar')
      <div class="layout-page">
        @include('layout.partials.header')
        <div class="content-wrapper">
          @yield('content')
          @include('layout.partials.footer')
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  @yield('js_script')
  <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/vendor/js/menu.js')}}"></script>

  <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

  <script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_KEY')}}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>



  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

  <!-- Main JS -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  <!-- Page JS -->
  <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>


  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_KEY')}}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
     $(document).ready(function () {
        tinymce.init({
          selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
          height: 300,
          menubar: false,
          plugins: 'code table lists',
          toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
      });
  </script>

  <script src="https://corporate-uk-stage.birdierun-dev.com/plugins/datatable/datatables.min.js"></script>
</body>

</html>
