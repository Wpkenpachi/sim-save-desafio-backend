<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class EmployeeRepository {

    private $employee;

    public function __construct()
    {
        $this->employee = app(Employee::class);
    }

    public function store($data) {
        try {
            DB::beginTransaction();
            $stored = $this->employee->create($data);
            DB::commit();
            return $stored;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update($data, $id) {
        try {
            DB::beginTransaction();
            $updated = $this->employee->where('id', $id)->update($data);
            DB::commit();
            return $this->employee->find($id);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function remove($id) {
        try {
            DB::beginTransaction();
            $deleted = $this->employee->where('id', $id)->delete();
            DB::commit();
            return (boolean) $deleted;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}