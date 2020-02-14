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

        function index(Request $request) {
            if (request()->ajax()) {
                if (!empty($request->filter_gender)) {
                    $data = DB::table('registerusers')
                            ->select('name', 'college')
                            //->where('gender', $request->filter_gender)
                            //->where('category', $request->filter_country)
                            ->get();
                } else {
                    $data = DB::table('registerusers')
                            ->select('name', 'gender', 'college')
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

}

/*
https://www.webslesson.info/2019/07/implement-custom-search-filter-in-laravel-58-datatable-using-ajax.html
*/