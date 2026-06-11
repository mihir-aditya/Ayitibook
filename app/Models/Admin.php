<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    protected $table = 'admins';

    protected $fillable = [
        'name', 'username', 'email', 'phone',
        'password', 'status', 'role', 'super_admin', 'last_login_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'super_admin'   => 'boolean',
        'status'        => 'boolean',  // DB tinyint: 1=active, 0=inactive
        'password'      => 'hashed',
    ];

    /* ── Role helpers ── */

    public function isAdmin(): bool   { return $this->role === 'admin'; }
    public function isManager(): bool { return $this->role === 'manager'; }
    public function isSupport(): bool { return $this->role === 'support'; }

    public function hasRole(string ...$roles): bool
    {
        if ($this->role === 'admin') return true;
        return in_array($this->role, $roles);
    }

    /* ── Status helpers ── */

    public function isActive(): bool   { return (bool) $this->status; }
    public function statusLabel(): string { return $this->status ? 'Active' : 'Inactive'; }
}