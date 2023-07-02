<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $users = User::all()->load('school');

        // dd($users[0]->school_id->name);
        return view('user.user',compact('users'));
    }

    function create()
    {
        $role = Role::all();
        $school = School::all();
        return view('user.create-user',compact('school','role'));
    }

    function store(Request $request)
    {
        $this->validate($request,[
            'nip' => 'required',
            'name' => 'required',
            'school_id' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'school_id' => $request->school_id,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        // dd($request->all());
        // return redirect('user');
        // return view('user.user')->with('massage','Data Berhasil Ditambah!');
        return Redirect::back()->with('message','Data added Successfully');
    }

    public function edit($id)
    {
        $user = user::findOrFail($id);
        $role = Role::all();
        $school = School::all();
        return view('user.user-edit', compact('user','role','school'));
    }

    public function update(Request $request, $id)
    {
        //validate form

       $user = \App\Models\User::findOrFail($id);
       $user->nip = $request->get('nip');
       $user->name = $request->get('name');
       $user->school_id = $request->get('school_id');
       $user->role_id = $request->get('role_id');
       $user->email = $request->get('email');
       $user->password = Hash::make($request->get('password'));
       $user->update();
    //    dd($user);
       //redirect to index
       return Redirect::back()->with('message','Data Update Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            return redirect()
                ->route('user.index')
                ->with('error','Data Deleted Successfully');
        } else {
            return redirect()
                ->route('user.index')
                ->with('error','Data Deleted Successfully');
        }

        // if ($user) {
        //     return view('user')
        //         ->with([
        //             'success' => 'User has been deleted successfully'
        //         ]);
        // } else {
        //     return view('user')
        //         ->with([
        //             'error' => 'User problem has occurred, please try again'
        //         ]);
        // }
    }

    public function import(Request $request)
    {
        Excel::import(new ImportUser,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function importView(Request $request)
    {
        Excel::import(new ImportUser,
        $request->file('file')->store('files'));
        return Redirect::back()->with('message','Data import Successfully');
    }

    public function exportUsers()
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function downloadfimport()
    {
        $filePath = public_path("formatimport.xlsx");
    	$headers = ['Content-Type: application/xlsx'];
    	$fileName = time().'.xlsx';

    	return response()->download($filePath, $fileName, $headers);
    }
}
