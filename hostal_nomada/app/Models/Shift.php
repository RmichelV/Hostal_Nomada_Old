<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = ['name','start_time','end_time'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Employee>
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
