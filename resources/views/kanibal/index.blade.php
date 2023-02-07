<!doctype html>
<html lang="en">
  <head>
    @include('layout.header')
  </head>
  <body>

<nav class="navbar navbar-dark sticky-top bg-danger flex-md-nowrap p-0 ml-auto">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 bg-danger" href="/productview">iMin App</a>
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
        <h1 class="h2">SN Kanibal</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <a href="/kanibal/export_excel" class="btn btn-sm btn-outline-success" target="_blank">Export</a>
          </div>
          <div class="btn-group mr-2">
          <a href="https://oss-sg.imin.sg/docs/en/index.html" class="btn btn-sm btn-outline-dark" target="_blank">SDK</a>
          </div>
        </div>
      </div>

      @if(session()->has('success'))
      <div class="alert alert-success fade show alert-dismissible" id='wowAlert' role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
        </div>
      @endif

      <div class="row">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
          <a href="/kanibal/create" class="btn btn-danger mb-3"> +New Service</a>
          <form action="/kanibal/cari" method="get">
                <div class="input-group mb-3 mr-2">
            <input type="text" class="form-control" placeholder="Search..." name="cari" value="{{ old('cari') }}">
            <div class="input-group-append">
              <button class="btn btn-danger" type="submit">Search</button>
            </div>
          </div>
        </form>
        </div>
      </div>

      <div class="table table-hover ">
        <table class="table table-striped table-sm">
          <thead style="color: #007bff">
            <tr>
              <th>No</th>
              <th>@sortablelink('tanggal')</th>
              <th>Serial Number</th>
              <th>Pelanggan</th>
              <th>Model</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($kanibal as $gabung)
            <tr>
                <td>{{ $kanibal->firstItem() + $loop->index }}</td>
                <td>{{ \Carbon\Carbon::parse($gabung->tanggal)->format('d/m/Y')}}</td>
                <td>{{ $gabung->serialnumber }}</td>
                <td>{{ $gabung->pelanggan }}</td>
                <td>{{ $gabung->model }}</td>
                <td>
                <a href="/kanibal/{{ $gabung->id }}/edit"
                class="badge bg-warning"><span data-feather="edit"></span></a>

                <a href="/kanibal/finish/{{ $gabung->id }}"
                class="badge bg-success"><span data-feather="send"></span></a>

                <a href="/kanibal/show/{{ $gabung->id }}"
              class="badge bg-info"><span data-feather="eye"></span></a>

                <form action="/kanibal/{{ $gabung->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                  <span data-feather="x-circle"></span></button>
              </form>
                </td>
            </tr>
            @endforeach

            </tbody>
            </table>
            <!-- <h6>Jumlah Service gabung : {{$kanibal->count()}}</h6> -->
            {{ $kanibal->links() }}
        </div>
        </main>
    </div>
    </div>

    @extends('layout.footer')
