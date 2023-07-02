@extends('layouts.app')
@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Report </h3>
    <p class="text-subtitle text-muted">Halaman Report.</p>
  </div>
  <div class="col-12 col-md-6 order-md-2 order-first">
    <nav
      aria-label="breadcrumb"
      class="breadcrumb-header float-start float-lg-end"
    >
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard') }}">Report</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Halaman Report
        </li>
      </ol>
    </nav>
  </div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="text-uppercase ms-4">Rekap Presensi {{ $presensi[0]->user->name }} ({{ $presensi[0]->user->nip }})</div>
                <div class="text-uppercase ms-4">Bulan {{ Carbon\carbon::parse($presensi[0]->tanggal)->format('M') }} {{ $year }}</div>
                <div class="card-body">
                  @isset($presensi)
                    <div class="table-responsive">
                      <table id="example" class="table table-striped mt-5" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tanggal/Hari</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Presensi Status</th>
                                <th>Presensi Jam</th>

                            </tr>
                        </thead>
                        <tbody>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped mt-5" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal/Hari</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Presensi Status</th>
                                            <th>Presensi Jam</th>
                                            <th>Hari Libur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $startOfMonth = now()->startOfMonth();
                                            $endOfMonth = now()->endOfMonth();
                                            $datesInRange = Carbon\CarbonPeriod::create($startOfMonth, $endOfMonth)->toArray();
                                        @endphp

                                        @foreach($datesInRange as $date)
                                        <tr>
                                            <td>{{ $date->isoFormat('dddd, D MMM Y') }}</td>
                                            <td>{{ $presensi[0]->user['nip'] }}</td>
                                            <td>{{ $presensi[0]->user->name }}</td>
                                            <td>
                                                @php
                                                    $filteredPresensi = $presensi->where('tanggal', $date->format('Y-m-d'));
                                                    $isWeekend = ($date->isWeekend() || $date->isSunday());
                                                    $filteredHoliday = $presensiholiday->where('holiday_date', $date->format('Y-m-d'))->first();
                                                    $isHoliday = ($isWeekend || $filteredHoliday);
                                                @endphp
                                                @if($filteredPresensi->isNotEmpty())
                                                    <button class="btn btn-primary text-uppercase">{{ $filteredPresensi[0]->presensistatus->as_name }} {{ $filteredPresensi[0]->masuk }}</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($filteredPresensi->isNotEmpty())
                                                    <button class="btn btn-primary text-uppercase">{{ $filteredPresensi[0]->presensihour->ph_name }}</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($isSunday)
                                                <span class="text-danger">Hari Libur: Minggu</span>
                                            @elseif($filteredHoliday)
                                                <span class="text-danger">{{ $filteredHoliday->holiday_desc }}</span>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </tbody>
                    </table>
                    </div>
                  @endisset
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



