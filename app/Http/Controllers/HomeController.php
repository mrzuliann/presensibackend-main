<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\PresensiHour;
use App\Models\PresensiStatus;
use App\Models\School;
use App\Models\User;
use App\Models\Pengumuman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $presensis = Presensi::select('presensis.*', 'users.name')
        //     ->join('users', 'presensis.user_id', '=', 'users.id')
        //     ->join('presensis_hour', 'presensis.ph_id', '=', 'presensis_hour.id')
        //     ->join('schools', 'users.school_id', '=', 'schools.id')
        //     // ->where('ph_id', '1', '2')
        //     // ->where('created_at', date('Y-m-d'))
        //     // ->whereDate('tanggal','DESC')
        //     // ->where('user_id', Auth::user()->id)
        //     ->get();
        // foreach ($presensis as $item) {
        //     $datetime = Carbon::parse($item->tanggal)->locale('id');

        //     $datetime->settings(['formatFunction' => 'translatedFormat']);

        //     $item->tanggal = $datetime->format('l, j F Y');
        // }

        // $presensis2 = Presensi::select('presensis.*', 'users.name')
        //     ->join('users', 'presensis.user_id', '=', 'users.id')
        //     ->join('presensis_hour', 'presensis.ph_id', '=', 'presensis_hour.id')
        //     ->where('ph_id', '2')
        //     ->orderBy('tanggal', 'DESC')
        //     // ->where('user_id', Auth::user()->id)
        //     ->get();
        // foreach ($presensis2 as $item) {
        //     $datetime = Carbon::parse($item->tanggal)->locale('id');

        //     $datetime->settings(['formatFunction' => 'translatedFormat']);

        //     $item->tanggal = $datetime->format('l, j F Y');
        // }
        // // dd($presensis);
        // return view('home', [
        //     'presensis' => $presensis,
        //     'presensis2' => $presensis2
        // ]);
        $user = User::count();
        $school = School::count();
        $presensi = Presensi::count();
        $pengumuman = Pengumuman::count();
        return view('home', compact('user','school','presensi','pengumuman'));
    }
}
