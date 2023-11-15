<?php

namespace App\Observers;

use App\Jobs\AuditLogJob;
use App\Library\Audit;
use App\Models\Client;
use App\Models\User;

class ClientObserver
{

    protected User $user;

    public function __construct()
    {
        $this->user = User::first();
    }

    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        $audit = new Audit($client, auth()->user(), 'created');
        AuditLogJob::dispatch($audit)->onQueue('audit_log');
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {

        $audit = new Audit($client, auth()->user(), 'updated');
        AuditLogJob::dispatch($audit)->onQueue('audit_log');
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        $audit = new Audit($client, auth()->user(), 'deleted');
        AuditLogJob::dispatch($audit)->onQueue('audit_log');
    }

}
