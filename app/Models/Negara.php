<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Negara extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'kode',
        'logo',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function provinsi(): HasMany
    {
        return $this->hasMany(Provinsi::class);
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
