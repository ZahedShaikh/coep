<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScholarshipStatus;
use Illuminate\Support\Facades\DB;

class newApplicationsController extends Controller {

    public function index() {
        return view('vendor.multiauth.admin.newScholarshipApplications');
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(Request $request) {

        if ($request->ajax()) {

            $output = '';
            $query = $request->get('query');

            if ($query != '') {

                $data = DB::table('registerusers')
                        ->where('id', 'LIKE', '%' . $query . '%')
                        ->orWhere('name', 'LIKE', '%' . $query . '%')
                        ->orderBy('id', 'desc')
                        ->get();
            } else {
                $data = DB::table('registerusers')
                        ->orderBy('id', 'desc')
                        ->get();
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {

                    $fullName = $row->name . " " . $row->middleName . " " . $row->surName;

                    $output .= '
                    <tr>
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

    public function update(Request $request) {
        //
    }

    public function accept(Request $request) {
        //
    }

    public function reject() {
        return view('vendor.multiauth.admin.home');
    }

    public function edit(ScholarshipStatus $ScholarshipStatus) {
        //
    }

    public function destroy(ScholarshipStatus $ScholarshipStatus) {
        //
    }

}
