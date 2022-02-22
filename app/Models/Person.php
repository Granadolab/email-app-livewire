<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $fillable=['user_id', 'city_id', 'dni', 'phone','birthday'];

    public function city()
    {
        return $this->belongsTo(City::class, 'id', 'city_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
