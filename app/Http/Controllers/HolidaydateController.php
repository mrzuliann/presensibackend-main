<?php

namespace App\Http\Controllers;

use App\Imports\HolidayDateImport;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;
use App\Models\HolidayDate;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;


class HolidaydateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     #jetstream #laravel #php #webdev

    public function getCURL()
    {
        // $client = new Client(); //GuzzleHttp\Client
        // $response = Curl::to('https://api-harilibur.vercel.app/api?year=2023')
        // ->withData(['title'=>'holiday_date', 'body'=>'holiday_name', 'userId'=>''])
        // ->get();

        // $response = Curl::to('https://api-harilibur.vercel.app/api?year=2023')
        // ->withData( array( 'foz' => 'baz' ) )
        // ->withHeader('Accept: application/json')
        // ->asJson()
        // ->get();

        // json_decode($response);
        // dd($response);

        return view('holidaydate.index', compact('response'));
    }

    public function apiWithKey()
    {
        $client = new Client();
        $url = "https://dev.to/api/articles/me/published";

        $params = [
            //If you have any Params Pass here
        ];

        $headers = [
            'api-key' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
        ];

        $response = $client->request('GET', $url, [
            // 'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('holidaydate.index', compact('responseBody'));
    }


    public function index()
    {
        $holidays = HolidayDate::all();
        return view('holidaydate.index', [
            'holidays' => $holidays
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('holidaydate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'holiday_name' => 'required',
            'holiday_desc' => 'required',
            'holiday_date' => 'required',
            'holiday_day' => 'required',
            'holiday_type' => 'required',
            'holiday_status' => 'required',
        ]);
        HolidayDate::create([
            'holiday_name' => $request->holiday_name,
            'holiday_desc' => $request->holiday_desc,
            'holiday_date' => $request->holiday_date,
            'holiday_day' => $request->holiday_day,
            'holiday_type' => $request->holiday_type,
            'holiday_status' => $request->holiday_status,
        ]);
        // dd($request->all());
        return redirect()->action('App\Http\Controllers\HolidaydateController@index')->with('message','Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensiholiday = HolidayDate::findOrFail($id);
        $presensiholiday->delete();

        if ($presensiholiday) {
            return redirect()
                ->route('presensiholiday.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('presensiholiday.index')
                ->with('error','Data Deleted Successfully');
        }
    }

    public function import(Request $request)
    {
        Excel::import(new HolidayDateImport,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function importView(Request $request)
    {
        Excel::import(new ImportSchool,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function exportSchools()
    {
        return Excel::download(new ExportSchool, 'holidaydate.xlsx');
    }

    public function downloadfimport()
    {
        $filePath = public_path("formatholidays.xlsx");
    	$headers = ['Content-Type: application/xlsx'];
    	$fileName = time().'.xlsx';

    	return response()->download($filePath, $fileName, $headers);
    }
}
