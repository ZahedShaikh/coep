<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScholarshipStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class sanctionAmountController extends Controller {

    public function index() {

        $data = DB::table('registerusers')
                ->join('scholarship_status', 'registerusers.id', '=', 'scholarship_status.id')
                ->where('scholarship_status.issuing_authority_status', '=', 'pending')
                ->orderBy('registerusers.id', 'desc')
                ->select('registerusers.id', 'registerusers.yearOfAdmission')
                ->get();

        $currentYear = date("Y");

        //check wehter records are empty or not!
        $total_row = $data->count();

        if ($total_row > 0) {
            foreach ($data as $row) {

                $months = date('m');
                $addMonths = 0;
                switch ($months) {
                    case ($months >= 7 and $months <= 11):
                        // This case for Semeseter 1
                        $addMonths = 2;
                        break;
                    case ($months >= 1 and $months <= 5):
                        // This case for Semeseter 2
                        $addMonths = 1;
                        break;
                    default:
                        // This case holidays
                        $addMonths = 0;
                }

                // Substracting 1 since I don't wanna count current year
                // Instead I will count $addMonths
                $years = $currentYear - date('Y', strtotime($row->yearOfAdmission)) - 1;

                /*
                 * Logic
                 * 1 = is added because current semester is 1
                 * $addMonths = is for adding current years semster
                 * $year = is twice since it have 2 semester
                 * 
                 */

                $forSemester = 1 + $addMonths + $years * 2;

                DB::table('scholarship_status')
                        ->where('id', $row->id)
                        ->update(['now_receiving_amount_for_semester' => $forSemester]);
            }
        }

        return view('vendor.multiauth.admin.sendSanctionAmountToAccounts');
    }

    public function show(Request $request) {

        if ($request->ajax()) {

            $output = '';
            $query = $request->get('query');

            if ($query != '') {

                $data = DB::table('registerusers')->join('scholarship_status', function ($join) {
                            $join->on('registerusers.id', '=', 'scholarship_status.id');
                        })
                        ->where('registerusers.id', 'LIKE', '%' . $query . '%')
                        ->orWhere('registerusers.name', 'LIKE', '%' . $query . '%')
                        ->where('scholarship_status.issuing_authority_status', '=', 'pending')
                        ->orderBy('registerusers.id', 'desc')
                        ->get();
            } else {

                $data = DB::table('registerusers')
                        ->join('scholarship_status', function ($join) {
                            $join->on('registerusers.id', '=', 'scholarship_status.id');
                        })
                        ->where('scholarship_status.issuing_authority_status', '=', 'pending')
                        ->orderBy('registerusers.id', 'desc')
                        ->get();


                /*
                 * Simplest way to do Joins
                 *  
                 */
                /*

                  $data = DB::table('registerusers')
                  ->join('scholarship_status', 'registerusers.id', '=', 'scholarship_status.id')
                  ->orderBy('registerusers.id', 'desc')
                  ->where('scholarship_status.issuing_authority_status', '=', 'pending')
                  ->select('registerusers*', 'scholarship_status*')
                  ->get();

                 */
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {

                    $fullName = $row->name . " " . $row->middleName . " " . $row->surName;
                    $amount = ($row->now_receiving_amount_for_semester - $row->prev_amount_received_in_semester) * 4000;

                    $output .= '
                    <tr id=\"' . $row->id . '\">
                    <td align=\'center\'>' . $row->id . '</td>
                    <td>' . $fullName . '</td>
                    <td>' . $row->college . '</td>
                    <td>' . $row->contact . '</td>
                    <td>' . $amount . "</td>
                    <td> <a onclick=\"$(this).assign('$row->id')\" class=\"btn btn-primary align-content-md-center\">Sanction Amount</a> </td>
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

    // Sanction remaining all application 
    public function sanction() {
        
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
                DB::table('amount_sanctioned_by_issuer')->insert(
                        ['id' => $studentID, "created_at" => Carbon::now(), "updated_at" => now()]
                );

                $sem = DB::table('scholarship_status')
                        ->where('id', '=', $studentID)
                        ->select('now_receiving_amount_for_semester')
                        ->first();

                if (intval($sem->now_receiving_amount_for_semester == 8)) {
                    DB::table('scholarship_status')->where('id', '=', $studentID)->delete();
                    DB::table('scholarship_tenure')->insert(
                            ['id' => $studentID, 'created_at' => Carbon::now(), 'updated_at' => now()]
                    );
                }

                DB::table('scholarship_status')
                        ->where('id', $studentID)
                        ->update(['issuing_authority_status' => 'approved']);

                DB::commit();
                $output = true;
            } catch (\Exception $e) {
                DB::rollback();
                return redirect(route('vendor.multiauth.admin.getSanctionAmount'))->with('message', 'Something went wrong');
            }

            echo json_encode($output);
        }
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
