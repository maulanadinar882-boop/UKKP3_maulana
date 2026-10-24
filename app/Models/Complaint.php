<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'name',
        'table_number', // <-- TAMBAHKAN INI
        'email',
        'phone',
        'category',
        'description',
        'attachment',
    ];
}
