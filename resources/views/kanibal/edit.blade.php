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
      <a class="dropdown-item" href="/dashboard"><i class="bi bi-house"></i> My Monitor</a>
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
        <h1 class="h2">Edit Data</h1>

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
        <form method="post" action="/kanibal/{{ $kanibal->id }} class="mb-5">
        @method('put')
        @csrf
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="text" class="form-control" id="tanggal"
          name="tanggal" placeholder="Masukan Tanggal" required value="{{old('tanggal', $kanibal->tanggal)}}">
        </div>
        <div class="form-group">
          <label for="serialnumber">Serial Number</label>
          <input type="text" class="form-control" id="serialnumber"
          name="serialnumber" placeholder="Masukan Serial Number" required value="{{ old('serialnumber') ?? $kanibal->serialnumber}}">
        </div>
        <div class="form-group">
          <label for="pelanggan">Pelanggan</label>
          <input type="text" class="form-control" id="pelanggan"
          name="pelanggan" placeholder="Masukan Nama Pelanggan" value="{{ old('pelanggan', $kanibal->pelanggan) }}" readonly>
        </div>
        <div class="form-group">
        <label for="model">Model</label>
        <select class="form-control selectpicker" id="model" name="model" data-live-search="true">
          <option value="Pilih Model">Pilih Model</option>
          <option value="D1" data-tokens="D1" {{ $kanibal->model == "D1" ? 'selected' : '' }} >D1</option>
          <option value="D1 Moka" data-tokens="D1 Moka" {{ $kanibal->model == "D1 Moka" ? 'selected' : '' }}>D1 Moka</option>
          <option value="D1-Pro" data-tokens="D1-Pro" {{ $kanibal->model == "D1-Pro" ? 'selected' : '' }}>D1-Pro</option>
          <option value="D1w" data-tokens="D1w" {{ $kanibal->model == "D1w" ? 'selected' : '' }}>D1w</option>
          <option value="D2-401" data-tokens="D2-401" {{ $kanibal->model == "D2-401" ? 'selected' : '' }}>D2-401</option>
          <option value="D2-402" data-tokens="D2-402" {{ $kanibal->model == "D2-402" ? 'selected' : '' }}>D2-402</option>
          <option value="D2-Pro" data-tokens="D2-Pro" {{ $kanibal->model == "D2-Pro" ? 'selected' : '' }}>D2-Pro</option>
          <option value="D3 504 lama" data-tokens="D3 504 lama" {{ $kanibal->model == "D3 504 lama" ? 'selected' : '' }}>D3 504 lama</option>
          <option value="D3 505 lama" data-tokens="D3 505 lama" {{ $kanibal->model == "D3 505 lama" ? 'selected' : '' }}>D3 505 lama</option>
          <option value="D3 506 lama" data-tokens="D3 506 lama" {{ $kanibal->model == "D3 506 lama" ? 'selected' : '' }}>D3 506 lama</option>
          <option value="D3-504" data-tokens="D3-504" {{ $kanibal->model == "D3-504" ? 'selected' : '' }}>D3-504</option>
          <option value="D3-505" data-tokens="D3-505" {{ $kanibal->model == "D3-505" ? 'selected' : '' }}>D3-505</option>
          <option value="D3-506" data-tokens="D3-506" {{ $kanibal->model == "D3-506" ? 'selected' : '' }} >D3-506</option>
          <option value="D3-501 Moka" data-tokens="D3-501 Moka" {{ $kanibal->model == "D3-501 Moka" ? 'selected' : '' }} >D3-501 Moka</option>
          <option value="D3-503 Moka" data-tokens="D3-503 Moka" {{ $kanibal->model == "D3-503 Moka" ? 'selected' : '' }} >D3-503 Moka</option>
          <option value="D3 DS1" data-tokens="D3 DS1" {{ $kanibal->model == "D3 DS1" ? 'selected' : '' }} >D3 DS1</option>
          <option value="D3 DS1 Extention Display" data-tokens="D3 DS1 Extention Display" {{ $kanibal->model == "D3 DS1 Extention Display" ? 'selected' : '' }} >D3 DS1 Extention Display</option>
          <option value="D3 DS1 Extention Display TS" data-tokens="D3 DS1 Extention Display TS" {{ $kanibal->model == "D3 DS1 Extention Display TS" ? 'selected' : '' }} >D3 DS1 Extention Display TS</option>
          <option value="D4-502" data-tokens="D4-502" {{ $kanibal->model == "D4-502" ? 'selected' : '' }} >D4-502</option>
          <option value="D4-503" data-tokens="D4-503" {{ $kanibal->model == "D4-503" ? 'selected' : '' }} >D4-503</option>
          <option value="D4-503 White" data-tokens="D4-503 White" {{ $kanibal->model == "D4-503 White" ? 'selected' : '' }} >D4-503 White</option>
          <option value="D4-504" data-tokens="D4-504" {{ $kanibal->model == "D4-504" ? 'selected' : '' }} >D4-504</option>
          <option value="D4-504 White" data-tokens="D4-504 White" {{ $kanibal->model == "D4-504 White" ? 'selected' : '' }} >D4-504 White</option>
          <option value="D4-505" data-tokens="D4-505" {{ $kanibal->model == "D4-505" ? 'selected' : '' }} >D4-505</option>
          <option value="D4-505 DT" data-tokens="D4-505 DT" {{ $kanibal->model == "D4-505 DT" ? 'selected' : '' }} >D4-505 DT</option>
          <option value="D4 Falcon 1" data-tokens="D4 Falcon 1" {{ $kanibal->model == "D4 Falcon 1" ? 'selected' : '' }} >D4 Falcon 1</option>
          <option value="M2-202" data-tokens="M2-202" {{ $kanibal->model == "M2-202" ? 'selected' : '' }} >M2-202</option>
          <option value="M2-202 iSeller" data-tokens="M2-202 iSeller" {{ $kanibal->model == "M2-202 iSeller" ? 'selected' : '' }} >M2-202 iSeller</option>
          <option value="M2-203" data-tokens="M2-203" {{ $kanibal->model == "M2-203" ? 'selected' : '' }}>M2-203</option>
          <option value="M2-203 iSeller" data-tokens="M2-203 iSeller" {{ $kanibal->model == "M2-203 iSeller" ? 'selected' : '' }}>M2-203 iSeller</option>
          <option value="M2-203 White" data-tokens="M2-203 White" {{ $kanibal->model == "M2-203 White" ? 'selected' : '' }}>M2-203 White</option>
          <option value="M2 Pro" data-tokens="M2 Pro" {{ $kanibal->model == "M2 Pro" ? 'selected' : '' }} >M2 Pro</option>
          <option value="M2 Max" data-tokens="M2 Max" {{ $kanibal->model == "M2 Max" ? 'selected' : '' }} >M2 Max</option>
          <option value="M2 Swift 1S" data-tokens="M2 Swift 1S" {{ $kanibal->model == "M2 Swift 1S" ? 'selected' : '' }} >M2 Swift 1S</option>
          <option value="M2 Swift 1P" data-tokens="M2 Swift 1P" {{ $kanibal->model == "M2 Swift 1P" ? 'selected' : '' }} >M2 Swift 1P</option>
          <option value="M2 Swift PDA" data-tokens="M2 Swift PDA" {{ $kanibal->model == "M2 Swift PDA" ? 'selected' : '' }} >M2 Swift PDA</option>
          <option value="M2 Swift 1 Scanner" data-tokens="M2 Swift 1 Scanner" {{ $kanibal->model == "M2 Swift 1 Scanner" ? 'selected' : '' }} >M2 Swift 1 Scanner</option>
          <option value="M2 Swift 1 Printer" data-tokens="M2 Swift 1 Printer" {{ $kanibal->model == "M2 Swift 1 Printer" ? 'selected' : '' }} >M2 Swift 1 Printer</option>
          <option value="R1 201" data-tokens="R1 201" {{ $kanibal->model == "R1 201" ? 'selected' : '' }} >R1 201</option>
          <option value="R1 202" data-tokens="R1 202" {{ $kanibal->model == "R1 202" ? 'selected' : '' }} >R1 202</option>
          <option value="S1 701" data-tokens="S1 701" {{ $kanibal->model == "S1 701" ? 'selected' : '' }} >S1 701</option>
          <option value="K1 101" data-tokens="K1 101" {{ $kanibal->model == "K1 101" ? 'selected' : '' }} >K1 101</option>
          <option value="K2 201" data-tokens="K1 201" {{ $kanibal->model == "K2 201" ? 'selected' : '' }} >K2 201</option>
          <option value="X1 Scanner" data-tokens="X1 Scanner" {{ $kanibal->model == "X1 Scanner" ? 'selected' : '' }} >X1 Scanner</option>
        </select>
      </div>
        <div class="form-group">
        <label for="ram">RAM/Storage</label>
        <select class="form-control" id="ram" name="ram">
          <option value="">Pilih RAM/Storage</option>
          <option value="-" {{ $kanibal->ram == "-" ? 'selected' : '' }} >-</option>
          <option value="1/8" {{ $kanibal->ram == "1/8" ? 'selected' : '' }} >1/8</option>
          <option value="2/8" {{ $kanibal->ram == "2/8" ? 'selected' : '' }} >2/8</option>
          <option value="2/16" {{ $kanibal->ram == "2/16" ? 'selected' : '' }} >2/16</option>
          <option value="4/16" {{ $kanibal->ram == "4/16" ? 'selected' : '' }} >4/16</option>
          <option value="4/32" {{ $kanibal->ram == "4/32" ? 'selected' : '' }} >4/32</option>
          <option value="4/64" {{ $kanibal->ram == "4/64" ? 'selected' : '' }} >4/64</option>
        </select>
      </div>
      <div class="form-group">
        <label for="android">Versi Android</label>
        <select class="form-control" id="android" name="android">
          <option value="">Pilih Versi Android</option>
          <option value="-" {{ $kanibal->android == "-" ? 'selected' : '' }} >-</option>
          <option value="Android 7" {{ $kanibal->android == "Android 7" ? 'selected' : '' }} >Android 7</option>
          <option value="Android 11" {{ $kanibal->android == "Android 11" ? 'selected' : '' }} >Android 11</option>
          <option value="Android 11 GMS" {{ $kanibal->android == "Android 11 GMS" ? 'selected' : '' }} >Android 11 GMS</option>
        </select>
      </div>
      <div class="form-group">
        <label for="garansi">Garansi</label>
        <select class="form-control" id="garansi" name="garansi">
          <option value="">Pilih Garansi</option>
          <option value="DOA (Garansi)"{{ $kanibal->garansi == "DOA (Garansi)" ? 'selected' : '' }}>DOA (Garansi)</option>
          <option value="RMA (Garansi)" {{ $kanibal->garansi == "RMA (Garansi)" ? 'selected' : '' }}>RMA (Garansi)</option>
          <option value="RMA (Tidak Garansi)" {{ $kanibal->garansi == "RMA (Tidak Garansi)" ? 'selected' : '' }}>RMA (Tidak Garansi)</option>
        </select>
      </div>
        <div class="form-group">
          <label for="kerusakan">Kerusakan</label>
          <input type="text" class="form-control" id="kerusakan" name="kerusakan" placeholder="Masukan Kerusakan" value="{{ old('kerusakan', $kanibal->kerusakan) }}">
        </div>

        {{-- <div class="form-group">
        <label for="kerusakanbawaan">Kerusakan Bawaan</label>
            <div class="btn-group btn-group-toggle product-options" data-toggle="buttons">
                <label class="btn btn-outline-success active">
                    <input type="radio" name="kerusakanbawaan" id="kerusakanbawaan1"
                    value="1" autocomplete="off"> Yes
                </label>
                <label class="btn btn-outline-danger">
                    <input type="radio" name="kerusakanbawaan" id="kerusakanbawaan2"
                    value="0" autocomplete="off" checked> No
                </label>
            </div>
        </div> --}}

        <div class="form-group">
        <label for="teknisi">Teknisi</label>
        <select class="form-control" id="teknisi" name="teknisi">
          <option value="">Pilih Teknisi</option>
          <option value="Khaerul" {{ $kanibal->teknisi == "Khaerul" ? 'selected' : '' }} >Khaerul</option>
          <option value="Ozi" {{ $kanibal->teknisi == "Ozi" ? 'selected' : '' }} >Ozi</option>
          <option value="Alfian" {{ $kanibal->teknisi == "Alfian" ? 'selected' : '' }} >Alfian</option>
          <option value="Other" {{ $kanibal->teknisi == "Other" ? 'selected' : '' }} >Other</option>
        </select>
      </div>
        <div class="form-group">
          <label for="perbaikan">Perbaikan</label>
          <input type="text" class="form-control" id="perbaikan" name="perbaikan" placeholder="Masukan Perbaikan" value="{{ old('perbaikan', $kanibal->perbaikan) }}">
        </div>
        <div class="form-group">
          <label for="snkanibal">SN Kanibal</label>
          <input type="text" class="form-control" id="snkanibal" name="snkanibal" placeholder="Masukan SN Kanibal" value="{{ old('snkanibal', $kanibal->snkanibal) }}">
        </div>
        <div class="form-group">
          <label for="nosparepart">No SparePart</label>
          <input type="text" class="form-control" id="nosparepart" name="nosparepart" placeholder="Masukan No SparePart" value="{{ old('nosparepart', $kanibal->nosparepart) }}">
        </div>
        <div class="form-group">
          <label for="note">Note</label>
          <textarea type="text" class="form-control" name="note" id="note" cols="30" rows="5" placeholder="Masukan Note">{{ $kanibal->note }}</textarea>
        </div>
        <button type="submit" class="btn btn-danger mb-5">Ubah Data</button>
        {{-- <!-- <a href="/kanibal/finish/{{ $kanibal->id }}"
                class="btn btn-success mb-5 ml-2"><span data-feather="send"></span>&nbspKirim Data</a> --> --}}
      </form>
    </div>

    @extends('layout.footer')
