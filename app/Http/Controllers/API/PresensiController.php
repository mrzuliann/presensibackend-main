<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\PresensiHour;
use App\Models\User;
use App\Models\School;
use App\Models\ApiBerita;
use App\Models\HolidayDate;
use Auth;
use Carbon\Carbon;
use DB;
use stdClass;

date_default_timezone_set("Asia/Kuala_Lumpur");

class PresensiController extends Controller
{
    function getPresensis()
    {
        $presensis = Presensi::where('user_id', Auth::user()->id)->get();
        foreach ($presensis as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }
            $datetime = Carbon::parse($item->tanggal)->locale('id');
            $masuk = Carbon::parse($item->masuk)->locale('id');
            $pulang = Carbon::parse($item->pulang)->locale('id');

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $pulang->settings(['formatFunction' => 'translatedFormat']);

            $item->tanggal = $datetime->format('l, j F Y');
            $item->masuk = $masuk->format('H:i');
            $item->pulang = $pulang->format('H:i');
        }

        return response()->json([
            'success' => true,
            'data' => $presensis,
            'message' => 'Sukses menampilkan data'
        ]);
    }
    function masukPresensi(Request $request)
    {
       // Ambil tanggal saat ini
       $tanggalSekarang = Carbon::now()->format('Y-m-d');
       // Ambil daftar tanggal libur dari tabel holidays
       $tanggalLibur = HolidayDate::pluck('holiday_name', 'holiday_date')->toArray();
       // Tambahkan hari Minggu ke dalam daftar tanggal libur
       $tanggalLibur[Carbon::now()->startOfWeek()->addDays(6)->format('Y-m-d')] = 'Hari Minggu';
       // Periksa apakah tanggal saat ini merupakan tanggal libur atau hari Minggu
       if (array_key_exists($tanggalSekarang, $tanggalLibur) || Carbon::now()->isSunday()) {
            // Jika ya, ambil deskripsi hari libur
            $deskripsiHariLibur = isset($tanggalLibur[$tanggalSekarang]) ? $tanggalLibur[$tanggalSekarang] : 'Hari Libur';

            return response()->json([
                'success' => false,
                'message' => $deskripsiHariLibur,
            ], 400)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        }

        $presensi = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
        ->where('user_id', Auth::user()->id)
        ->where("ph_id", $request->ph_id)
        ->first();
        if ($presensi !== null) {
        // Jika data absensi sudah ada, maka melakukan return data tersebut
        return $presensi;
        } else {
        $presensi = Presensi::create([
        'user_id' => Auth::user()->id,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'tanggal' => date('Y-m-d'),
        'masuk' => date('H:i:s'),
        'ph_id' => $request->ph_id,
        'ps_id' => $request->ps_id,
        ]);
        }
        // $presensi = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
        // ->first();
        // $request->user()->tokens()->delete();
        return response()->json([
        'success' => true,
        'data' => $presensi,
        // 'response' => $response,
        'message' => '200, Sukses simpan',
        ])->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');

    }

    function pulangPresensi(Request $request)
    {

        $presensi = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
        ->where('user_id', Auth::user()->id)
        ->first();
        if ($presensi !== null) {
        // Jika data absensi sudah ada, maka melakukan return data tersebut
        return $presensi;
        } else {
        $presensi = Presensi::create([
        'user_id' => Auth::user()->id,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'tanggal' => date('Y-m-d'),
        'masuk' => date('H:i:s'),
        'ph_id' => $request->ph_id,
        'ps_id' => $request->ps_id,
        ]);
        }
        // $presensi = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
        // ->first();
        // $request->user()->tokens()->delete();
        return response()->json([
        'success' => true,
        'data' => $presensi,
        // 'response' => $response,
        'message' => '200, Sukses simpan',
        ])->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        //end
    }

    public function GetUsers()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'Sukses simpan'
        ]);
    }

    public function GetSekolah()
    {
        $data = School::all();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses menampilkan data Sekolah'
        ]);
    }

    public function berita()
    {
        $data = ApiBerita::all();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses menampilkan data Sekolah'
        ]);
    }

    public function presensiHour()
    {
        $presensihour = PresensiHour::all();
        return response()->json([
            'success' => true,
            'data' => $presensihour,
            'message' => '200, Sukses Menampilkan data'
        ]);
    }

    public function laporan(Request $request)
    {
        $presensis = Presensi::select(
             'users.name',
             DB::raw('MONTH(presensis.created_at) AS bulan'),
             DB::raw('YEAR(presensis.created_at) AS tahun'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 1 THEN 1 END) AS hadir'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 2 THEN 1 END) AS tidak_hadir'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 3 THEN 1 END) AS izin'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 4 THEN 1 END) AS sakit'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 5 THEN 1 END) AS cuti'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 6 THEN 1 END) AS tugas'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 7 THEN 1 END) AS izin_terlambat'),
             DB::raw('COUNT(CASE WHEN presensis.ps_id = 8 THEN 1 END) AS izin_pulang_cepat'))
             ->join('users', 'presensis.user_id', '=', 'users.id') ->groupBy('users.name','bulan','tahun')->get();
             return response()->json([
                'success' => true,
                'data' => $presensis,
                'message' => '200, Sukses Menampilkan data'
            ]);
    }

}
