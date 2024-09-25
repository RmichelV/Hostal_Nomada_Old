<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use HasFactory;
    protected $fillable = ['name','salary'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Employee>
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
