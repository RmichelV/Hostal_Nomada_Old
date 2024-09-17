<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nacionalidad extends Model
{
    use HasFactory;

    protected $table = 'nacionalidades';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre'];
    public $timestamps=false;

    public function users(){
        return $this->hasMany( User::class, 'rol_id', 'id');
    }

}
