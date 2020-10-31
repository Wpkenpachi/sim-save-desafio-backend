<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->employee = new EmployeeRepository();
    }

    public function createEmployee(Request $request) {
        $validator = Validator::make($request->all(), [
            'company_id'    => 'required|integer',
            'name'          => 'required|string',
            'role'          => 'required|string',
            'email'         => 'required|string',
            'phone'         => 'required|string',
            'admission_date'=> 'required|date_format:"Y-m-d"'
        ]);

        if ($validator->fails()) {
            return response()->json( $validator->errors() );
        }

        $created = $this->employee->store($request->all());
        return $created;
    }

    public function editEmployee(Request $request, $id) {
        $updated = $this->employee->update($request->all(), $id);
        return $updated;
    }

    public function deleteEmployee($id) {
        $deleted = $this->employee->remove($id);
        return $deleted ? response()->json(["msg" => "Employee successfully removed."]) : response()->json(["msg" => "Error trying to remove employee, maybe it does not  exists anymore."], 500);
    }
}
