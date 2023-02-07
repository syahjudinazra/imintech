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

<div class="container-fluid">
  <div class="row">
    @include ('layout.sidebar')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Service Done</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        {{-- <button type="button" class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#importExcel">
			Import Excel
		</button> --}}
          <div class="btn-group mr-2">
          <a href="/servicedone/export_excel" class="btn btn-sm btn-outline-success" target="_blank">Export</a>
          </div>
          <div class="btn-group mr-2">
          <a href="https://oss-sg.imin.sg/docs/en/index.html" class="btn btn-sm btn-outline-dark" target="_blank">SDK</a>
          </div>
        </div>
      </div>

      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" id='wowAlert' role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
        </div>
      @endif


		{{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif

		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ $sukses }}</strong>
		</div>
		@endif

		<!-- Import Excel -->
		{{-- <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/servicedone/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
							@csrf
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-success">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div> --}}


      <div class="row">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
          <a href="/servicedone/create" class="btn btn-danger mb-3"> +New Service</a>
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
        @foreach ($barang as $item)
              <tr>
              <td>{{ $barang->firstItem() + $loop->index }}</td>
              <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y')}}</td>
              <td>{{ $item->serialnumber }}</td>
              <td>{{ $item->pelanggan }}</td>
              <td>{{ $item->model }}</td>
              {{-- <td>
                <input data-id="{{$item->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                data-offstyle="danger" data-toggle="toggle" data-on="yes" data-off="no" {{ $item->kerusakanbawaan ? 'checked' : '' }}>
              </td> --}}
              <td>
              <a href="/servicedone/{{ $item->id }}/edit"
                class="badge bg-warning"><span data-feather="edit"></span></a>

              <a href="/servicedone/show/{{ $item->id }}"
              class="badge bg-info"><span data-feather="eye"></span></a>

              <form action="/servicedone/{{ $item->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                  <span data-feather="x-circle"></span></button>
              </form>
            </td>
          </tr>
        @endforeach
        <tr>
        {{-- <td>Total</td>
        <td>{{ $barang->count('id') }}</td> --}}
        </tr>
          </tbody>
        </table>
        {{-- <!-- <h6>Jumlah Service Selesai : {{$barang->count()}}</h6> --> --}}
        {{ $barang->links()}}
      </div>
    </main>
  </div>
</div>

@extends('layout.footer')
