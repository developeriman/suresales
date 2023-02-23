<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Codes extends Model
{
    use HasFactory;
    protected $table = 'codes';
    protected $fillable = ['template_id', 'code', 'status'];

    public function template(): BelongsTo
    {
        return $this->belongsTo(Templates::class, 'template_id' );
    }



}
