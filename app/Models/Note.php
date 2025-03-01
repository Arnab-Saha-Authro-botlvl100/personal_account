<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $table = 'notes';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'user',
        'title',
        'date',
        'description',
        'status',
    ];
}
