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
      <a class="dropdown-item" href="#"><i class="bi bi-house"></i> My Monitor</a>
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

<div class="container-fluid">
  <div class="row">
    @include ('layout.sidebar')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Service Monitoring</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <a href="https://oss-sg.imin.sg/docs/en/index.html" class="btn btn-sm btn-outline-dark" target="_blank">SDK</a>
          </div>
        </div>
      </div>

    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <p>Total Service Done</p>
                            <h3>{{ $barang->total() }}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
            </div>
            <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <p>Total Service Pending</p>
                            <h3>{{ $barangsp->total() }}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
            </div>
            <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <p>Total Kanibal</p>
                            <h3>{{ $kanibal->total() }}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                    </div>
            </div>
        </div>
    </div>

      <div class="row">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
          <h2>Service Done</h2>
          <form action="/servicedone/cari" method="get">
                <div class="input-group mb-3 mr-2">
            <input type="text" class="form-control" placeholder="Search..." name="cari" value="{{ old('cari') }}">
            <div class="input-group-append">
              <button class="btn btn-danger" type="submit">Search</button>
            </div>
          </div>
        </form>
        </div>
      </div>

        <div class="table-responsive table-hover">
          <table class="table table-striped table-sm">
            <thead class="bg-danger">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Serial Number</th>
                <th>Pelanggan</th>
                <th>Model</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
          @foreach ($barang as $item)
                <tr>
                <td>{{ $barang->firstItem() + $loop->index }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y')}}</td>
                <td>{{ $item->serialnumber }}</td>
                <td>{{ $item->pelanggan }}</td>
                <td>{{ $item->model }}</td>
                <td>
                <a href="/servicedone/show/{{ $item->id }}"
              class="badge bg-info"><span data-feather="eye"></span></a>
                </td>
            </tr>
          @endforeach
            </tbody>
          </table>
         {{-- <h6>Jumlah Service Selesai : {{ $barang->count('barangs') }}</h6> --}}
         {{ $barang->appends($_GET)->links() }}
        </div>


        <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
          <h2>Service Pending</h2>
          <form action="/servicepending/cari" method="get">
                <div class="input-group mb-3 mr-2">
            <input type="text" class="form-control" placeholder="Search..." name="cari" value="{{ old('cari') }}">
            <div class="input-group-append">
              <button class="btn btn-danger" type="submit">Search</button>
            </div>
          </div>
        </form>
        </div>
      </div>

        <div class="table-responsive table-hover">
          <table class="table table-striped table-sm">
            <thead class="bg-warning">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Serial Number</th>
                <th>Pelanggan</th>
                <th>Model</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
          @foreach ($barangsp as $item)
                <tr>
                <td>{{ $barangsp->firstItem() + $loop->index }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y')}}</td>
                <td>{{ $item->serialnumber }}</td>
                <td>{{ $item->pelanggan }}</td>
                <td>{{ $item->model }}</td>
                <td>
                <a href="/servicepending/show/{{ $item->id }}"
              class="badge bg-info"><span data-feather="eye"></span></a>
                </td>
            </tr>
          @endforeach
            </tbody>
          </table>
          {{-- <!-- <h6>Jumlah Service Pending : {{$barangsp->count()}}</h6> --> --}}
          {{ $barangsp->appends($_GET)->links() }}
        </div>

        <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
          <h2>Kanibal</h2>
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

        <div class="table-responsive table-hover">
          <table class="table table-striped table-sm">
            <thead class="bg-dark">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Serial Number</th>
                <th>Pelanggan</th>
                <th>Model</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
          @foreach ($kanibal as $item)
                <tr>
                <td>{{ $kanibal->firstItem() + $loop->index }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y')}}</td>
                <td>{{ $item->serialnumber }}</td>
                <td>{{ $item->pelanggan }}</td>
                <td>{{ $item->model }}</td>
                <td>
                <a href="/kanibal/show/{{ $item->id }}"
              class="badge bg-info"><span data-feather="eye"></span></a>
                </td>
            </tr>
          @endforeach
            </tbody>
          </table>
          {{-- <!-- <h6>Jumlah Service Pending : {{$barangsp->count()}}</h6> --> --}}
          {{ $kanibal->appends($_GET)->links() }}
        </div>
      </main>
    </div>
  </div>



      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>
  </div>
</div>

@extends('layout.footer')
