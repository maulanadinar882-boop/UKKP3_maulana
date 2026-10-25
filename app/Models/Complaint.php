<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id',
    'category',
    'customer_name',
    'phone',
    'table_number',
    'title',
    'content',
    'attachment',
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}