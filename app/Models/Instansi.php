<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instansi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nss',
        'npsn',
        'logo',
        'telepon',
        'email',
        'website',
        'no_sk_pendirian',
        'tanggal_pendirian',
        'pimpinan_id',
        'alamat',
        'negara_id',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tanggal_pendirian' => 'date',
        'pimpinan_id' => 'integer',
        'negara_id' => 'integer',
        'provinsi_id' => 'integer',
        'kabupaten_id' => 'integer',
        'kecamatan_id' => 'integer',
        'kelurahan_id' => 'integer',
    ];

    public function pimpinan(): BelongsTo
    {
        return $this->belongsTo(Pimpinan::class);
    }

    public function negara(): BelongsTo
    {
        return $this->belongsTo(Negara::class);
    }

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class);
    }
}
