<?php

namespace App\Http\Controllers;

use App\scholarship_grants;
use Illuminate\Http\Request;

class AssignScholarshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function show(scholarship_grants $scholarship_grants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function edit(scholarship_grants $scholarship_grants)
    {
        return view('vendor.multiauth.admin.assignScholarships');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, scholarship_grants $scholarship_grants)
    {
        $data = new scholarship_grants();
        
        $data->id = $request->input('student_list');
        $data->scholarshipGranted = 'yes';
        
        #$grants->fill($data)->save();
        $data->save();
        #return view('vendor.multiauth.admin.home');
        return redirect(route('admin.home'))->with('message', 'Please update your marks first');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\scholarship_grants  $scholarship_grants
     * @return \Illuminate\Http\Response
     */
    public function destroy(scholarship_grants $scholarship_grants)
    {
        //
    }
}
