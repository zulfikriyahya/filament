<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pimpinan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nip',
        'periode_awal',
        'periode_akhir',
        'ttd',
        'foto',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'periode_awal' => 'date',
        'periode_akhir' => 'date',
        'status' => 'boolean',
    ];

    public function instansi(): HasMany
    {
        return $this->hasMany(Instansi::class);
    }
}
