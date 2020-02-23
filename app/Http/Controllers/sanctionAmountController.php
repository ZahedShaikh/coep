<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScholarshipStatus;

class sanctionAmountController extends Controller {

    public function index() {
        return view('vendor.multiauth.admin.sendSanctionAmountToAccounts');
    }

    public function show(Request $request) {

        if ($request->ajax()) {

            $output = '';
            $query = $request->get('query');

            if ($query != '') {

                $data = DB::table('registerusers')->join('scholarship_applicants', function ($join) {
                            $join->on('registerusers.id', '=', 'scholarship_applicants.id');
                        })
                        ->where('registerusers.id', 'LIKE', '%' . $query . '%')
                        ->orWhere('registerusers.name', 'LIKE', '%' . $query . '%')
                        ->orderBy('registerusers.id', 'desc')
                        ->get();
            } else {
                $data = DB::table('registerusers')
                        ->join('scholarship_applicants', function ($join) {
                            $join->on('registerusers.id', '=', 'scholarship_applicants.id');
                        })
                        ->orderBy('registerusers.id', 'desc')
                        ->get();
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {

                    $fullName = $row->name . " " . $row->middleName . " " . $row->surName;

                    $output .= '
                    <tr id=\"' . $row->id . '\">
                    <td align=\'center\'>' . $row->id . '</td>
                    <td>' . $fullName . '</td>
                    <td>' . $row->college . '</td>
                    <td>' . $row->contact . "</td>
                    <td> <a onclick=\"$(this).assign('$row->id')\" class=\"btn btn-primary align-content-md-center\">Sanction</a> </td>
                    </tr>
                    ";
                }
            } else {
                $output = '
            <tr>
            <td align="center" colspan="5">No Data Found</td>
            </tr>
            ';
            }

            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScholarshipStatus  $ScholarshipStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ScholarshipStatus $ScholarshipStatus) {
        //
    }
    
    public function send(Request $request) {

        if ($request->ajax()) {
            $output = false;
            $studentID = $request->get('query');
            try {
                DB::beginTransaction();

                ScholarshipStatus::create([
                    'id' => $studentID,
                ]);

                scholarship_accepted_list::create([
                    'id' => $studentID,
                ]);

                DB::table('scholarship_applicants')->where('id', '=', $studentID)->delete();

                DB::commit();
                $output = true;
            } catch (\Exception $e) {
                DB::rollback();
                return redirect(route('vendor.multiauth.admin.newScholarshipApplications'))->with('message', 'Something went wrong');
            }

            echo json_encode($output);
        }
    }
    
    public function sendToAccounts(Request $request, ScholarshipStatus $ScholarshipStatus) {

        /*
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
          $s = 0;
          $f = 0;

          for ($x = 0; $x < $string[count($string) - 1]; $x++) {
          $data = new ScholarshipStatus();
          $data->id = (int) $string[$x];
          $data->scholarshipGranted = 'yes';
          try {
          $data->save();
          $success[$s] = (int) $string[$x];
          $s++;
          } catch (\Illuminate\Database\QueryException $exc) {
          $faild[$f] = (int) $string[$x];
          $f++;
          #dd($exc->getMessage());
          }
          $data = null;
          }
         */
        return redirect(route('admin.home'))->with('message', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScholarshipStatus  $ScholarshipStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScholarshipStatus $ScholarshipStatus) {
        //
    }

}
