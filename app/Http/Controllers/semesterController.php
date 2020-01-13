<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\semesterMarks;
use Illuminate\Support\Facades\DB;

class semesterController extends Controller {

    public function redirectTo() {
        return $this->redirectTo = route('home');
    }

    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        return view('home');
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(semesterMarks $semesterMarks) {
        //
    }

    public function edit(semesterMarks $semesterMarks) {

        $marks = DB::table('semester_Marks')->where('id', Auth::user()->id)->first();
        //dd($marks);
        return view('marks.marks')->with('marks', $marks);
    }

    public function update(Request $request, semesterMarks $semesterMarks) {

        $task = semesterMarks::findOrFail(Auth::user()->id);

        $this->validate($request, [
            'semester1' => 'nullable|numeric|digits_between:0,2',
            'semester2' => 'nullable|numeric|digits_between:0,2',
            'semester3' => 'nullable|numeric|digits_between:0,2',
            'semester4' => 'nullable|numeric|digits_between:0,2',
            'semester5' => 'nullable|numeric|digits_between:0,2',
            'semester6' => 'nullable|numeric|digits_between:0,2',
            'semester7' => 'nullable|numeric|digits_between:0,2',
            'semester8' => 'nullable|numeric|digits_between:0,2'
        ]);


        $input = $request->all();

        //CGPA

        $semester1 = $request->input('semester1');
        $semester2 = $request->input('semester2');
        $semester3 = $request->input('semester3');
        $semester4 = $request->input('semester4');
        $semester5 = $request->input('semester5');
        $semester6 = $request->input('semester6');
        $semester7 = $request->input('semester7');
        $semester8 = $request->input('semester8');

        $sum = 0;
        $count = 0;

        if ($semester1) {
            $sum = $sum + $semester1;
            $count++;
        }
        if ($semester2) {
            $sum = $sum + $semester2;
            $count++;
            if ($count != 2) {
                $count = -8;
            }
        }
        if ($semester3) {
            $sum = $sum + $semester3;
            $count++;
            if ($count != 3) {
                $count = -8;
            }
        }
        if ($semester4) {
            $sum = $sum + $semester4;
            $count++;
            if ($count != 4) {
                $count = -8;
            }
        }

        if ($semester5) {
            $sum = $sum + $semester5;
            $count++;
            if ($count != 5) {
                $count = -8;
            }
        }
        if ($semester6) {
            $sum = $sum + $semester6;
            $count++;
            if ($count != 6) {
                $count = -8;
            }
        }
        if ($semester7) {
            $sum = $sum + $semester7;
            $count++;
            if ($count != 7) {
                $count = -8;
            }
        }
        if ($semester8) {
            $sum = $sum + $semester8;
            $count++;
            if ($count != 8) {
                $count = -8;
            }
        }

        $CGPA = $sum / $count;
        $task->CGPA = $CGPA;


        $date1 = DB::table('registerusers')
                        ->select('yearOfAdmission')
                        ->where('id', Auth::user()->id)->first();
        $dateOfAdmit = strtotime($date1->yearOfAdmission);
        //dd(gettype($dateOfAdmit));

        $now = date('Y-m-d');
        $todaysDate = strtotime($now);
        //dd(gettype($todaysDate));

        $diff = ( $todaysDate - $dateOfAdmit ) / ( 86400 );
        $monthDiff = floor(floor($diff / 30.5) / 36);
        //dd($diff);
        //dd($monthDiff);
        //dd($count);

        if ($count >= $monthDiff) {
            $task->updated = 'yes';
            $task->fill($input)->save();
            return redirect(route('home'))->with('message', 'Marks updated successfully');
        } else {
            $task->updated = 'no';
            $task->fill($input)->save();
            return redirect(route('home'))->with('message', 'Marks updated with error. Add your all semester marks');
        }
    }

    public function destroy(semesterMarks $semesterMarks) {
        //
    }

}
