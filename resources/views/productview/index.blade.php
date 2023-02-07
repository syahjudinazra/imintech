<!doctype html>
<html lang="en">
  <head>
    @include('layout.header')
  </head>
  <body>

<nav class="navbar navbar-dark sticky-top bg-danger flex-md-nowrap p-0 ml-auto">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 bg-danger" href="#">iMin App</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  @auth
  <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" style="color:white; href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Welcome Back, {{ auth()->user()->name }}
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/monitor"><i class="bi bi-house"></i> My Monitor</a>
      <div class="dropdown-divider"></div>

        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>

    </div>
  </div>

  @else
  <div class="nav-item">
    <a class="nav-link" style="color:white" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
  </div>
  @endauth

</nav>

<!-- isi menu -->
<div class="container-fluid">
  <div class="row">
    @include ('layout.sidebar')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Product View</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <a href="https://oss-sg.imin.sg/docs/en/index.html" class="btn btn-sm btn-outline-dark" target="_blank">SDK</a>
          </div>
        </div>
      </div>

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-color: white">
            <img src="{{ asset('/images/1.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;"  alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/2.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/3.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/4.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/5.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/6.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/7.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/8.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/9.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/10.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/11.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
            <div class="carousel-item" style="background-color: white">
            <img src="{{ asset('/images/12.jpg') }}" class="d-block h-50 mx-auto" style="width: 60rem;" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>

    </div>

    @extends('layout.footer')
