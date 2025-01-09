<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunPelajaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'status',
    ];
    protected $casts = [
        'nama' => 'string',
        'status' => 'string',
    ];
    // public function negara(): BelongsTo
    // {
    //     return $this->belongsTo(Negara::class);
    // }
}
