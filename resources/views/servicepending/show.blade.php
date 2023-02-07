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
        <h1 class="h2">Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <!-- <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-success">Export</button>
          </div> -->
        </div>
      </div>


      <div class="col-lg-8">
      @foreach ($barangsp as $detail)

        <form method="post" action="/servicepending">
        @csrf

        <button class="btn btn-outline-danger mb-4" id="copyBtn" data-text="*Tanggal :* {{ $detail->tanggal }} | *SerialNumber : {{ $detail->serialnumber }} | *Pelanggan :* {{ $detail->pelanggan }} | *Model :* {{ $detail->model }} | *RAM/Storage :* {{ $detail->ram }} | *Versi Android :* {{ $detail->android }} | *Kerusakan :* {{ $detail->kerusakan }} |  *Kerusakan Bawaan :* {{ $detail->kerusakanbawaan }} | *Teknisi :* {{ $detail->teknisi }} | *Perbaikan :* {{ $detail->perbaikan }} | *SNKanibal :* {{ $detail->snkanibal }} | *No SparePart :* {{ $detail->nosparepart }} | *Note :* {{ $detail->note }}">
            Copy Data</button>

        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="text" class="form-control" id="tanggal"
          name="tanggal" placeholder="Masukan Tanggal" required autofocus value="{{ old('tanggal', $detail->tanggal) }}" disabled>
        </div>
        <div class="form-group">
          <label for="serialnumber">Serial Number</label>
          <input type="text" class="form-control" id="serialnumber"
          name="serialnumber" placeholder="Masukan Serial Number" required value="{{ old('serialnumber', $detail->serialnumber) }}" disabled>
        </div>
        <div class="form-group">
          <label for="pelanggan">Pelanggan</label>
          <input type="text" class="form-control" id="pelanggan"
          name="pelanggan" placeholder="Masukan Nama Pelanggan" value="{{ old('pelanggan', $detail->pelanggan) }}" disabled>
        </div>
        <div class="form-group">
          <label for="model">Model</label>
          <input type="text" class="form-control" id="model"
          name="model" placeholder="Masukan Nama model" value="{{ old('model', $detail->model) }}" disabled>
        </div>
        <div class="form-group">
          <label for="ram">Ram/Storage</label>
          <input type="text" class="form-control" id="ram"
          name="ram" placeholder="Masukan Nama Ram" value="{{ old('ram', $detail->ram) }}" disabled>
        </div>
        <div class="form-group">
          <label for="android">Versi Android</label>
          <input type="text" class="form-control" id="android"
          name="android" placeholder="Masukan Nama Android" value="{{ old('android', $detail->android) }}" disabled>
        </div>
        <div class="form-group">
          <label for="kerusakan">Kerusakan</label>
          <input type="text" class="form-control" id="kerusakan" name="kerusakan" placeholder="Masukan Kerusakan" value="{{ old('kerusakan', $detail->kerusakan) }}" disabled>
        </div>
        <div class="form-group">
          <label for="teknisi">Teknisi</label>
          <input type="text" class="form-control" id="teknisi"
          name="teknisi" placeholder="Masukan Nama teknisi" value="{{ old('teknisi', $detail->teknisi) }}" disabled>
        </div>
        <div class="form-group">
          <label for="perbaikan">Perbaikan</label>
          <input type="text" class="form-control" id="perbaikan" name="perbaikan" placeholder="Masukan Perbaikan" value="{{ old('perbaikan', $detail->perbaikan) }}" disabled>
        </div>
        <div class="form-group">
          <label for="snkanibal">SN Kanibal</label>
          <input type="text" class="form-control" id="snkanibal" name="snkanibal" placeholder="Masukan SN Kanibal" value="{{ old('snkanibal', $detail->snkanibal) }}" disabled>
        </div>
        <div class="form-group">
          <label for="nosparepart">No SparePart</label>
          <input type="text" class="form-control" id="nosparepart" name="nosparepart" placeholder="Masukan No SparePart" value="{{ old('nosparepart', $detail->nosparepart) }}" disabled>
        </div>
        <div class="form-group">
          <label for="note">Note</label>
          <input type="text" class="form-control" id="note" name="note" placeholder="Masukan Note" value="{{ old('note', $detail->note) }}" disabled>
        </div>
      </form>
      @endforeach
    </div>

    @extends('layout.footer')
