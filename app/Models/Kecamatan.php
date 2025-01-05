<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'kabupaten_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kabupaten_id' => 'integer',
    ];

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kelurahan(): HasMany
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function instansi(): HasMany
    {
        return $this->hasMany(Instansi::class);
    }

    public function instansiLain(): HasMany
    {
        return $this->hasMany(InstansiLain::class);
    }
}
