<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\registeruser;
use App\semesterMarks;
use Illuminate\Support\Facades\DB;

class ProfilePrintController extends Controller {

    public function redirectTo() {
        return $this->redirectTo = route('home');
    }

    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        return view('home');
    }

    public function show(semesterMarks $semesterMarks) {
        
        $marks = DB::table('semester_Marks')->where('id', Auth::user()->id)->first();

        if ($marks->updated == 'yes') {
            $banks = DB::table('bank_details')->where('id', Auth::user()->id)->first();
            if ($banks->updated == 'yes') {
                $info = DB::table('registerusers')->where('id', Auth::user()->id)->first();
                return view('print.profile', compact('info','marks','banks'));
            } else {
                return redirect(route('home'))->with('message', 'Please update your Bank details');
            }
        } else {
            return redirect(route('home'))->with('message', 'Please update your marks first');
        }
    }

}
