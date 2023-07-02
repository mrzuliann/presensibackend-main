@extends('layouts.app')

@section('dashboard')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Dashboard</h3>
    <p class="text-subtitle text-muted">Halaman Dashboard.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Dashboard
        </li>
      </ol>
    </nav>
  </div>
@endsection

    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon purple mb-2">
                    <i class="bi bi-people"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">
                    User
                  </h6>
                  <h6 class="font-extrabold mb-0">{{$user}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon blue mb-2">
                    <i class="bi bi-house-gear-fill"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Sekolah</h6>
                  <h6 class="font-extrabold mb-0">{{$school}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon green mb-2">
                    <i class="bi bi-collection"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Rekap Kehadiran</h6>
                  <h6 class="font-extrabold mb-0">{{$presensi}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon red mb-2">
                    <i class="iconly-boldBookmark"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Hari Libur</h6>
                  <h6 class="font-extrabold mb-0">-</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



{{-- </div> --}}
<script type="text/javascript" class="init">


$(document).ready(function () {
	var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
});

</script>

@endsection



