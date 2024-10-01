<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'employee_id',
        'type',
        'res_date',
        'entry_date',
        'depature_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


    // Relación many-to-many con rooms
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reservation_rooms')
                    ->withTimestamps(); // Si necesitas las marcas de tiempo en la tabla pivote
    }


}
