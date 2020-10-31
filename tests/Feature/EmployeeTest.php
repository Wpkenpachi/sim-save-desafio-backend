<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Employee;

class EmployeeTest extends TestCase
{
    private $company;

    private function clearDb() {
        DB::table('companies')->where('cnpj', '29642341000142')->delete();
        $this->company = Company::create([
            'name' => "SimSave",
            'cnpj' => "29642341000142",
            'address' => "Rua XXXXX, XXXX - XXXXXX - Belo Horizonte / MG"
        ]);
        Employee::where('email', 'wpdev@gmail.com')->delete();
    }

    public function testCreateEmployee() {
        $this->clearDb();
        $employee_data = [
            "company_id"    => $this->company->id,
            "name"          => "Wesley Dev",
            "role"          => "Backend Developer",
            "email"         => "wpdev@gmail.com",
            "phone"         => "9999999999",
            "admission_date"=> "2020-10-31"
        ];
        $response = $this->postJson('/api/employee', $employee_data);
        $response->assertStatus(201)
                ->assertJson($employee_data);
    }

    public function testCreateInvalidEmployee() {
        $this->clearDb();
        $employee_data = [
            "company_id"    => $this->company->id,
            "name"          => "Wesley Dev",
            "role"          => "Backend Developer",
            "email"         => "wpdev@gmail.com",
            "admission_date"=> "2020-10-31"
        ];
        $response = $this->postJson('/api/employee', $employee_data);
        $response->assertStatus(200)
                ->assertJson([
                    "phone" => [
                        "The phone field is required."
                    ]
                ]);
    }

    public function testUpdateEmployee() {
        $this->clearDb();
        $update_data = ["name" => "Wesley Paulo"];
        $employee_data = [
            "company_id"    => (Company::first())->id,
            "name"          => "Wesley Dev",
            "role"          => "Backend Developer",
            "email"         => "wpdev@gmail.com",
            "phone"         => "9999999999",
            "admission_date"=> "2020-10-31"
        ];
        $employee = Employee::create($employee_data);
        $employee_data['name'] = "Wesley Paulo";
        $response = $this->postJson('/api/employee/' . $employee->id, $update_data);
        $response->assertStatus(200)
                ->assertJson($employee_data);
    }

    public function testDeleteEmployee() {
        $this->clearDb();
        $employee_data = [
            "company_id"    => (Company::first())->id,
            "name"          => "Wesley Dev",
            "role"          => "Backend Developer",
            "email"         => "wpdev@gmail.com",
            "phone"         => "9999999999",
            "admission_date"=> "2020-10-31"
        ];
        $employee = Employee::create($employee_data);
        $response = $this->deleteJson('/api/employee/' . $employee->id);
        $response->assertStatus(200)
                ->assertJson([
                        "msg" => "Employee successfully removed."
                ]);
    }

    public function testFailedDeleteEmployee() {
        $this->clearDb();
        $response = $this->deleteJson('/api/employee/300');
        $response->assertStatus(500)
                ->assertJson([
                        "msg" => "Error trying to remove employee, maybe it does not  exists anymore."
                ]);
    }
}
