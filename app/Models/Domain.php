<?php

namespace App\Models;

use App\Exceptions\DomainCannotBeChangedException;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

/**
 * @property int $id
 * @property int $tenant_id
 * @property string $domain
 * @property bool $is_primary
 * @property bool $is_fallback
 * @property string $certificate_status
 * @property Tenant $tenant
 */
class Domain extends BaseDomain
{
    protected $casts = [
        'is_primary' => 'bool',
        'is_fallback' => 'bool',
    ];

    protected $fillable = ['domain', 'tenant_id'];

    public static function booted()
    {
        static::updating(function (self $model) {
            if ($model->getAttribute('domain') !== $model->getOriginal('domain')) {
                throw new DomainCannotBeChangedException;
            }
        });

        static::saved(function (self $model) {
            // There can only be one of these
            $uniqueKeys = ['is_primary', 'is_fallback'];

            foreach ($uniqueKeys as $key) {
                if ($model->$key) {
                    $model->tenant->domains()
                        ->where('id', '!=', $model->id)
                        ->update([$key => false]);
                }
            }
        });
    }

    public static function domainFromSubdomain(string $subdomain): string
    {
        return $subdomain.'.'.config('tenancy.central_domains')[0];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function makePrimary(): self
    {
        $this->update([
            'is_primary' => true,
        ]);

        $this->tenant->setRelation('primary_domain', $this);

        return $this;
    }

    public function makeFallback(): self
    {
        $this->update([
            'is_fallback' => true,
        ]);

        $this->tenant->setRelation('fallback_domain', $this);

        return $this;
    }

    public function isSubdomain(): bool
    {
        return ! Str::contains($this->domain, '.');
    }

    /**
     * Get the domain type.
     * Returns 'subdomain' or 'domain'.
     */
    public function getTypeAttribute(): string
    {
        return $this->isSubdomain() ? 'subdomain' : 'domain';
    }
}
