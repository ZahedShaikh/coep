<?php

namespace App\Http\Controllers\Auth;

use App\registeruser;
use App\semesterMarks;
use App\BankDetails;
use App\Students_Current_Year;
use App\ScholarshipStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {

    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct() {
        $this->middleware('guest');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'surName' => ['required', 'string', 'max:255'],
                    'gender' => ['required'],
                    'yearOfAdmission' => ['required', 'string', 'max:255'],
                    'contact' => ['required', 'string', 'max:10'],
                    'college' => ['required'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:registerusers'],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data) {

        try {
            DB::beginTransaction();

            $user = registeruser::create([
                        'name' => $data['name'],
                        'middleName' => $data['middleName'],
                        'surName' => $data['surName'],
                        'category' => $data['category'],
                        'gender' => $data['gender'],
                        'college' => $data['college'],
                        'collegeEnrollmentNo' => $data['collegeEnrollmentNo'],
                        'yearOfAdmission' => $data['yearOfAdmission'],
                        'contact' => $data['contact'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
            ]);

            $id = $user->id; // Get current user id

            semesterMarks::create([
                'id' => $id,
            ]);

            BankDetails::create([
                'id' => $id,
            ]);

            Students_Current_Year::create([
                'id' => $id,
            ]);

            ScholarshipStatus::create([
                'id' => $id,
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return view('auth.login');
        }
    }

}
