<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFiles extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'code_id', 'data'];
    protected $table = 'upload_files';
}
