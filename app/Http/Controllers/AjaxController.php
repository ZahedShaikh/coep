<?php

namespace App\Http\Controllers;

use App\registeruser;
use Illuminate\Http\Request;
use Redirect,
    Response;

class AjaxController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['users'] = registeruser::orderBy('id', 'ASC')->paginate(8);

        return view('vendor.multiauth.admin.ajax-crud', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $userId = $request->user_id;
        $user = registeruser::updateOrCreate(['id' => $userId],
                        ['name' => $request->name, 'email' => $request->email]);

        return Response::json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $where = array('id' => $id);
        $user = registeruser::where($where)->first();

        return Response::json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = registeruser::where('id', $id)->delete();

        return Response::json($user);
    }

}
