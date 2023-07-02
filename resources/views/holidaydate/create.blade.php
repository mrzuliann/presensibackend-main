@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Hari Libur</h3>
    <p class="text-subtitle text-muted">Halaman Tambah Hari Libur.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{url('dashboard')}}">Hari Libur</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Tambah Hari Libur
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Tambah Hari Libur</div>

                <div class="card-body">
                    <form method="POST"  action="{{ url('store-presensiholiday') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Nama Hari Libur</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="holiday_name" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Deskripsi Hari Libur</label>
                            <textarea type="text" class="form-control" id="exampleInputEmail1" name="holiday_desc" aria-describedby="emailHelp" required></textarea>

                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Tanggal Hari Libur</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" name="holiday_date" aria-describedby="emailHelp" required>

                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Hari Libur</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="holiday_day" aria-describedby="emailHelp" required>

                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Type Hari Libur</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="holiday_type" aria-describedby="emailHelp" required>

                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Status Hari Libur</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" name="holiday_status" aria-describedby="emailHelp" required>

                        </div>

                        <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go Back</a></button>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
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



