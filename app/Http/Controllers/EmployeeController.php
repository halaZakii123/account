<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('add_employee');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'password'=>'required|string|min:8',
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
     User::create(['name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'parent_id'=> Auth::id(),
         'company_name'=>Auth::user()->company_name]);
        return redirect("/home");

    }

}
