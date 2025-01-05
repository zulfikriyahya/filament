<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provinsi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'negara_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'negara_id' => 'integer',
    ];

    public function negara(): BelongsTo
    {
        return $this->belongsTo(Negara::class);
    }

    public function kabupaten(): HasMany
    {
        return $this->hasMany(Kabupaten::class);
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
