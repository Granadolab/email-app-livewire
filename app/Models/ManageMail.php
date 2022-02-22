<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageMail extends Model
{
    use HasFactory;

    protected $table = 'mails';
    protected $fillable = ['user_id', 'subject', 'destination', 'message'];
}
