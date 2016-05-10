<!DOCTYPE html>
<html lang="en">
<head>

  <!-- title -->
  <title>{{ $title }}</title>

  <!-- meta -->
  <meta charset="utf-8">
  <meta name="description" content="CMS . gov">
  <meta name="author" content="Joseph Watkin">

  <!-- mobile specific -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS and JS assets -->
  @include('layouts.css')
    <!-- JS -->
  @include('layouts.js')

</head>

<body>
@include('layouts.header')
  <!-- navbar -->
<div class="container">
<div class="row">
    <div class="col-sm-12">
      @include('layouts.notifications')
        <!-- body (content) -->
      @yield('body')
    </div>
  </div>
</div>
@include('layouts.footer')
</body>
</html>
