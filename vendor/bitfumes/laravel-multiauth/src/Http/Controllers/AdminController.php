<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bitfumes\Multiauth\Model\Admin;
use Bitfumes\Multiauth\Model\Role;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only' => 'show']);
    }

    public function index() {

        $role_id = DB::table('admin_role')->where('admin_id', auth()->id())->pluck('role_id');
        $num = $role_id['0'];

        /*
         * Role id [assigned as $num]
         * 1: Super Admin User
         * 2: Vendor Admin User
         */
        
        if ($num == '1') {
            return view('multiauth::admin.home');
        } else if ($num == '2') {
            return view('multiauth::vendor.home');
        } else {
            return view('multiauth::admin.home');
        }
    }

    public function show() {
        $admins = Admin::where('id', '!=', auth()->id())->get();

        return view('multiauth::admin.show', compact('admins'));
    }

    public function showChangePasswordForm() {
        return view('multiauth::admin.passwords.change');
    }

    public function changePassword(Request $request) {
        $data = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        auth()->user()->update(['password' => bcrypt($data['password'])]);

        return redirect(route('admin.home'))->with('message', 'Your password is changed successfully');
    }

}
