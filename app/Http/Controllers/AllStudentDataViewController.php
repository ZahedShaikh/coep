<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\registeruser;

class AllStudentDataViewController extends Controller {

    public function ajaxRequest(Request $request) {
        return view('vendor.multiauth.admin.allStudentDataView');
    }

    public function index(Request $request) {

        /*
        $students = DB::table('registerusers')
                ->select('name')
                ->orderBy('name', 'ASC')
                ->get();

        return view('/', compact('students'));

        */

        if (request()->ajax()) {
            if (!empty($request->filter_gender)) {
                $data = DB::table('registerusers')
                        ->select('name')
                        ->orderBy('name', 'ASC')
                        ->get();
            } else {
                $data = DB::table('registerusers')
                        ->select('name')
                        ->get();
            }
            return datatables()->of($data)->make(true);
        }
        
        $country_name = DB::table('registerusers')
                ->select('name')
                ->orderBy('name', 'ASC')
                ->get();
        return view('vendor.multiauth.admin.allStudentDataView', compact('country_name'));
    }

}
