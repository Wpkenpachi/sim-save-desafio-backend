<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Employee;

class CompanyTest extends TestCase
{
    private $company;
    private $employees;

    private function setDb() {
        Company::where('cnpj', '29642341000142')->delete();
        $this->company = Company::create([
            'name' => "SimSave",
            'cnpj' => "29642341000142",
            'address' => "Rua XXXXX, XXXX - XXXXXX - Belo Horizonte / MG"
        ]);
        $this->employees = [
            [
                "company_id"    => $this->company->id,
                "name"          => "Paulo Bk",
                "role"          => "Backend Developer",
                "email"         => "pbk@gmail.com",
                "phone"         => "9999999999",
                "admission_date"=> "2020-10-31"
            ],
            [
                "company_id"    => $this->company->id,
                "name"          => "Wesley Ft",
                "role"          => "Frontend Developer",
                "email"         => "wft@gmail.com",
                "phone"         => "9999999999",
                "admission_date"=> "2020-10-31"
            ]
        ];
        Employee::whereIn('email', ['pbk@gmail.com', 'wft@gmail.com'])->delete();
        DB::table('companies')->insert($employees);
    }

    public function testCompanyDetailsWithEmployees() {
        $company = Company::where('cnpj', '29642341000142')->first();
        $company->employees = $this->employees;
        $response = $this->getJson('/api/company/' . $company->id);
        $response->assertStatus(200)
                ->assertJson($company->toArray());
    }
}
