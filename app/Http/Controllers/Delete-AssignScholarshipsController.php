<?php

namespace App\Http\Controllers;

use App\scholarship_grants;
use Illuminate\Http\Request;

class AssignScholarshipsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function show(scholarship_grants $scholarship_grants) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function edit(scholarship_grants $scholarship_grants) {
        return view('vendor.multiauth.admin.assignScholarships');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, scholarship_grants $scholarship_grants) {

        // Cleaning up data to be human error free!
        $string = $request->input('student_list');
        $string = str_replace(' ', '', $string);
        $string = explode(",", $string);

        if ((int) $string[count($string) - 1] == 0) {
            unset($string[count($string) - 1]);
            dd($string[count($string) - 1]);
        }

        
        $faild = [];    // List of record failed to insert
        $success = [];  // LIst of records succsed to insert
        $s= 0;
        $f= 0;

        for ($x = 0; $x < $string[count($string) - 1]; $x++) {
            $data = new scholarship_grants();
            $data->id = (int) $string[$x];
            $data->scholarshipGranted = 'yes';
            try {
                $data->save();
                $success[$s] = (int)$string[$x];
                $s++;
            } catch (\Illuminate\Database\QueryException $exc) {
                $faild[$f] = (int)$string[$x];
                $f++;
                #dd($exc->getMessage());
            }
            $data = null;
        }

        return redirect(route('admin.home'))->with('message', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function destroy(scholarship_grants $scholarship_grants) {
        //
    }

}
