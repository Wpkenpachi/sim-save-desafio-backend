<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        "company_id",
        "name",
        "role",
        "email",
        "phone",
        "admission_date"
    ];

    public function company() {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }
}
