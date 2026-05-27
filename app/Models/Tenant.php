<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    /**
     * Attribute casts.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'active' => 'boolean',
        'data' => 'array',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'user_id',
            'name',
            'app_name',
            'active',
        ];
    }

    // public function getIncrementing()
    // {
    //     return true;
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Tenant $tenant) {
            if (empty($tenant->app_name) && ! empty($tenant->user_id)) {
                $user = User::find($tenant->user_id);
                if ($user && ! empty($user->name)) {
                    $tenant->app_name = $user->name . "'s App";
                }
            }
        });
    }
}
