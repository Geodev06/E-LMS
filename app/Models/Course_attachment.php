<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'attachment_desc',
        'attachment_sys_file_name',
        'attachment_orig_file_name',
        'attachment_path'
    ];
}
