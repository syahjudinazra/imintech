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
      <a class="dropdown-item" href="/dashboard"><i class="bi bi-house"></i> My Dashboard</a>
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
        <h1 class="h2">Tambah Data Baru</h1>

        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
        @endif

        <div class="btn-toolbar mb-2 mb-md-0">
          <!-- <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-success">Export</button>
          </div> -->
        </div>
      </div>

    <div class="col-lg-8">
        <form method="post" action="/servicedone">
        @csrf
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" id="tanggal"
          name="tanggal" placeholder="Masukan Tanggal" required autofocus value="{{ old('tanggal') }}">
        </div>
        <div class="form-group">
          <label for="serialnumber">Serial Number</label>
          <input type="text" class="form-control" id="serialnumber"
          name="serialnumber" placeholder="Masukan Serial Number" required value="{{ old('serialnumber') }}">
        </div>
        <div class="form-group">
          <label for="pelanggan">Pelanggan</label>
          <input type="text" class="form-control" id="pelanggan"
          name="pelanggan" placeholder="Masukan Nama Pelanggan" value="{{ old('pelanggan') }}">
        </div>
        <div class="form-group">
        <label for="model">Model</label>
        <select class="form-control selectpicker" name="model" id="model" data-live-search="true" required>
          <option value="Pilih Model">Pilih Model</option>
          <option value="D1" data-tokens="D1">D1</option>
          <option value="D1 Moka" data-tokens="D1 Moka">D1 Moka</option>
          <option value="D1-Pro" data-tokens="D1-Pro">D1-Pro</option>
          <option value="D1w" data-tokens="D1w">D1w</option>
          <option value="D2-401" data-tokens="D2-401">D2-401</option>
          <option value="D2-402" data-tokens="D2-402">D2-402</option>
          <option value="D2-Pro" data-tokens="D2-Pro">D2-Pro</option>
          <option value="D3-504 lama" data-tokens="">D3-504 lama</option>
          <option value="D3-505 lama" data-tokens="D3-505 lama">D3-505 lama</option>
          <option value="D3-506 lama" data-tokens="D3-506 lama">D3-506 lama</option>
          <option value="D3-504" data-tokens="D3-504">D3-504</option>
          <option value="D3-505" data-tokens="D3-505">D3-505</option>
          <option value="D3-506" data-tokens="D3-506">D3-506</option>
          <option value="D3-501 Moka" data-tokens="D3-501 Moka">D3-501 Moka</option>
          <option value="D3-503 Moka" data-tokens="D3-503 Moka">D3-503 Moka</option>
          <option value="D3 DS1" data-tokens="D3 DS1">D3 DS1</option>
          <option value="D3 DS1 Extention Display" data-tokens="D3 DS1 Extention Display">D3 DS1 Extention Display</option>
          <option value="D3 DS1 Extention Display TS" data-tokens="D3 DS1 Extention Display TS">D3 DS1 Extention Display TS</option>
          <option value="D4-502" data-tokens="D4-502">D4-502</option>
          <option value="D4-503" data-tokens="D4-503">D4-503</option>
          <option value="D4-503 White" data-tokens="D4-503 White">D4-503 White</option>
          <option value="D4-504" data-tokens="D4-504">D4-504</option>
          <option value="D4-504 White" data-tokens="D4-504 White">D4-504 White</option>
          <option value="D4-505" data-tokens="D4-505">D4-505</option>
          <option value="D4-505 DT" data-tokens="D4-505 DT">D4-505 DT</option>
          <option value="D4 Falcon 1" data-tokens="D4 Falcon 1">D4 Falcon 1</option>
          <option value="M2-202" data-tokens="M2-202">M2-202</option>
          <option value="M2-202 iSeller" data-tokens="M2-202 iSeller">M2-202 iSeller</option>
          <option value="M2-203" data-tokens="M2-203">M2-203</option>
          <option value="M2-203 iSeller" data-tokens="M2-203 iSeller">M2-203 iSeller</option>
          <option value="M2-203 White" data-tokens="M2-203 White">M2-203 White</option>
          <option value="M2 Pro" data-tokens="M2 Pro">M2 Pro</option>
          <option value="M2 Max" data-tokens="M2 Max">M2 Max</option>
          <option value="M2 Swift 1S" data-tokens="M2 Swift 1S">M2 Swift 1S</option>
          <option value="M2 Swift 1P" data-tokens="M2 Swift 1P">M2 Swift 1P</option>
          <option value="M2 Swift PDA" data-tokens="M2 Swift PDA">M2 Swift PDA</option>
          <option value="M2 Swift 1 Scanner" data-tokens="M2 Swift 1 Scanner">M2 Swift 1 Scanner</option>
          <option value="M2 Swift 1 Printer" data-tokens="M2 Swift 1 Printer">M2 Swift 1 Printer</option>
          <option value="R1-201" data-tokens="R1-201">R1-201</option>
          <option value="R1-202" data-tokens="R1-202">R1-202</option>
          <option value="S1-701" data-tokens="S1-701">S1-701</option>
          <option value="K1-101" data-tokens="K1-101">K1-101</option>
          <option value="K2-201" data-tokens="K2-201">K2-201</option>
          <option value="X1 Scanner" data-tokens="X1 Scanner">X1 Scanner</option>
        </select>
      </div>
      <div class="form-group">
        <label for="ram">RAM/Storage</label>
        <select class="form-control" id="ram" name="ram" value="{{ old('ram') }}" required>
          <option>Pilih RAM/Storage</option>
          <option>-</option>
          <option>1/8</option>
          <option>2/8</option>
          <option>2/16</option>
          <option>4/16</option>
          <option>4/32</option>
          <option>4/64</option>
        </select>
      </div>
        <div class="form-group">
        <label for="android">Versi Android</label>
        <select class="form-control" id="android" name="android" value="{{ old('android') }}" required>
          <option>Pilih Versi Android</option>
          <option>-</option>
          <option>Android 7</option>
          <option>Android 11</option>
          <option>Android 11 GMS</option>
        </select>
      </div>
        <div class="form-group">
          <label for="kerusakan">Kerusakan</label>
          <input type="text" class="form-control" id="kerusakan" name="kerusakan" placeholder="Masukan Kerusakan" value="{{ old('kerusakan') }}">
        </div>

        <div class="form-group">
        <label for="kerusakanbawaan">Kerusakan Bawaan</label>
            <div class="btn-group btn-group-toggle product-options" data-toggle="buttons">
                <label class="btn btn-outline-success active">
                    <input type="radio" name="kerusakanbawaan" id="kerusakanbawaan" value="1" autocomplete="off"> Yes
                </label>
                <label class="btn btn-outline-danger">
                    <input type="radio" name="kerusakanbawaan" id="kerusakanbawaan" value="0" autocomplete="off" checked> No
                </label>
            </div>
        </div>

        <div class="form-group">
        <label for="teknisi">Teknisi</label>
        <select class="form-control" id="teknisi" name="teknisi" required>
          <option>Pilih Teknisi</option>
          <option>Khaerul</option>
          <option>Ozi</option>
          <option>Alfian</option>
          <option>Other</option>
        </select>
      </div>
        <div class="form-group">
          <label for="perbaikan">Perbaikan</label>
          <input type="text" class="form-control" id="perbaikan" name="perbaikan" placeholder="Masukan Perbaikan" value="{{ old('perbaikan') }}">
        </div>
        <div class="form-group">
          <label for="snkanibal">SN Kanibal</label>
          <input type="text" class="form-control" id="snkanibal" name="snkanibal" placeholder="Masukan SN Kanibal" value="{{ old('snkanibal') }}">
        </div>
        <div class="form-group">
          <label for="nosparepart">No SparePart</label>
          <input type="text" class="form-control" id="nosparepart" name="nosparepart" placeholder="Masukan No SparePart" value="{{ old('nosparepart') }}">
        </div>
        <div class="form-group">
          <label for="note">Note</label>
          <input type="text" class="form-control" id="note" name="note" placeholder="Masukan Note" value="{{ old('note') }}">
        </div>
        <button type="submit" class="btn btn-danger mb-5">Tambah Data</button>
      </form>
    </div>

    @extends('layout.footer')
