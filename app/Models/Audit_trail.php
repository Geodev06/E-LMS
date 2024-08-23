<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit_trail extends Model
{
    use HasFactory;

    protected $fillable = ['activity', 'content', 'prev_value', 'current_value','created_by'];
}
