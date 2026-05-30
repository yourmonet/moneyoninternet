<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanDana extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_pengajuan',
        'jumlah_dana',
        'keterangan',
        'status',
        'catatan_pengurus',
        'file_pendukung',
    ];

    /**
     * Get the user that owns the fund request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
