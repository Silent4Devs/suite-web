<?php

namespace App;

use App\Models\Domain;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Http;

class PloiManager
{
    /** @var string */
    protected $site;

    /** @var string */
    protected $token;

    /** @var string */
    protected $server;

    public function __construct(Repository $config)
    {
        $this->site = $config->get('services.ploi.site');
        $this->token = $config->get('services.ploi.token');
        $this->server = $config->get('services.ploi.server');
    }

    /**
     * Add tenant :80 vhost
     */
    public function addDomain(Domain $domain): void
    {
        if ($domain->isSubdomain() || ! $this->token) {
            return;
        }

        if (gethostbyname($domain->domain) !== gethostbyname(Domain::domainFromSubdomain(tenant()->fallback_domain->domain))) {
            return;
        }

        Http::withToken($this->token)->asJson()->acceptJson()
            ->post(
                "https://ploi.io/api/servers/{$this->server}/sites/{$this->site}/tenants",
                [
                    'tenants' => [$domain->domain],
                ]
            );
    }

    /**
     * Remove a tenant :80 host.
     */
    public function removeDomain(Domain $domain): void
    {
        if ($domain->isSubdomain() || ! $this->token) {
            return;
        }

        Http::withToken($this->token)->asJson()->acceptJson()
            ->delete("https://ploi.io/api/servers/{$this->server}/sites/{$this->site}/tenants/$domain->domain");
    }

    /**
     * Request a certificate for a tenant host.
     */
    public function requestCertificate(Domain $domain): void
    {
        if ($domain->isSubdomain() || ! $this->token) {
            return;
        }

        Http::withToken($this->token)->asJson()->acceptJson()
            ->post(
                "https://ploi.io/api/servers/{$this->server}/sites/{$this->site}/tenants/{$domain->domain}/request-certificate",
                [
                    'webhook' => tenant()->route('tenant.ploi.certificate.issued'),
                ]
            );

        $domain->update(['certificate_status' => 'pending']);
    }

    /**
     * Revoke a certificate for a tenant host.
     */
    public function revokeCertificate(Domain $domain): void
    {
        if ($domain->isSubdomain() || ! $this->token) {
            return;
        }

        Http::withToken($this->token)->asJson()->acceptJson()
            ->post(
                "https://ploi.io/api/servers/{$this->server}/sites/{$this->site}/tenants/{$domain->domain}/revoke-certificate",
                [
                    'webhook' => tenant()->route('tenant.ploi.certificate.revoked'),
                ]
            );

        $domain->update(['certificate_status' => 'pending']);
    }

    /**
     * Let ploi know about a tenant's database.
     */
    public function acknowledgeDatabase(string $databaseName): void
    {
        if (! $this->token) {
            return;
        }

        Http::withToken($this->token)->asJson()->acceptJson()
            ->post(
                "https://ploi.io/api/servers/{$this->server}/databases/acknowledge",
                [
                    'name' => $databaseName,
                    'description' => 'Tenant database',
                ]
            );

        // Create a backup if you want: https://developers.ploi.io/database-backups/create-backup
    }

    /**
     * Make ploi forget a tenant database.
     */
    public function forgetDatabase(string $databaseName): void
    {
        if (! $this->token) {
            return;
        }

        Http::withToken($this->token)->asJson()->acceptJson()
            ->delete("https://ploi.io/api/servers/{$this->server}/databases/$databaseName/forget");
    }
}
