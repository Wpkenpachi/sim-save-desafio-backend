<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'cnpj', 'address',
    ];

    public function employees() {
        return $this->hasMany('App\Models\Employee', 'company_id', 'id');
    }
}
