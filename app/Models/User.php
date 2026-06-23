<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'role',
        'avatar',
        'phone_number',
        'department',
        'status_kepatuhan_kas',
        'account_status',
        'verification_code',
        'verification_code_expires_at',
    ];

    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    public function isPengurus(): bool
    {
        return $this->role === 'pengurus';
    }

    public function isBendahara(): bool
    {
        return $this->role === 'bendahara';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isWaitingApproval(): bool
    {
        return $this->account_status === 'waiting';
    }

    public function getDashboardRoute(): string
    {
        return match($this->role) {
            'pengurus'  => '/pengurus/dashboard',
            'bendahara' => '/bendahara/dashboard',
            'admin'     => '/admin/dashboard',
            default     => '/user/dashboard',
        };
    }

    public function kasMasuks()
    {
        return $this->hasMany(KasMasuk::class);
    }

    public function penagihans()
    {
        return $this->hasMany(Penagihan::class);
    }

    public function pengajuanDanas()
    {
        return $this->hasMany(PengajuanDana::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verification_code_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
