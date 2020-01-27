<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Illuminate\Http\Request;
//use Bitfumes\Multiauth\Model\Role;
use Illuminate\Routing\Controller;
use Bitfumes\Multiauth\Model\ScholarshipGrants;
use Illuminate\Foundation\Auth\RegistersUsers;

class ScholarshipGrantsController extends Controller {

    use RegistersUsers;

    public $redirectTo;

    public function redirectTo() {
        return $this->redirectTo = route('admin.show');
    }

    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }

    protected function create(array $data) {

        $grant = scholarship_grants::create([
                    'scholarshipGranted' => $data['scholarshipGranted'],
                    'scholarshipName' => $data['scholarshipName'],
                    'id' => $data['id'],
        ]);

        return $grant;
    }

    public function edit(ScholarshipGrants $ScholarshipGrants) {
        $banks = DB::table('scholarship_grants')->where('id', Auth::user()->id)->first();
        //dd($marks);
        return view('admin.assignScholarships')->with('banks', $banks);
    }

    public function update(Request $request, ScholarshipGrants $ScholarshipGrants) {
        $task = ScholarshipGrants::findOrFail(Auth::user()->id);
        
        $input = $request->all();
        $task->fill($input)->save();
        return redirect(route('admin.home'))->with('message', 'updated successfully');
    }

}
