<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Montserrat:300,400,500">

            {{-- Vue Development mode --}}
 <script async src="{{ asset('js/vue.js') }}"></script> 
<script src="https://unpkg.com/vue@3"></script>

 
 
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> --}}
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}">

{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('mdb/css/mdb.css') }}">

{{-- ////////////////////////   ./ axios --}}
<script defer async src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script async src="{{ asset('js/axios.js') }}"></script> 

<!--   custom styles -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
 
             <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
</head>
<body>
    <header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <a href="/" class="brand h4 font-weight-bold">DevProx</a>
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarRightAlignExample"
      aria-controls="navbarRightAlignExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarRightAlignExample">
      <!-- Left links -->
      <ul class="navbar-nav ms-auto   ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/test1') }}">test 1</a>
        </li>
   
        <li class="nav-item">
          <a class="nav-link disabled"
            >Disabled</a
          >
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
    </header>
    <main class="bg-light p-3">
        {{-- Main Content --}}
          @yield('content')
    </main>
    {{-- footer --}}
    <footer class="d-flex justify-content-center">
<div class=""><a href="" class="text-dark">DevProx Job Test</a></div>
    </footer>
</body>
</html>
