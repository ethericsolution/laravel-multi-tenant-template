<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\App\User as TenantUser;
use App\Notifications\TenantWelcomeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TenantOnboardingJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Tenant $tenant,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $domain = $this->tenant
            ->domains()
            ->first()
            ?->domain;


        $this->tenant->run(function () use ($domain) {
            $user = TenantUser::create([
                'name'     => $this->tenant->name,
                'email'    => $this->tenant->email,
                'password' => bcrypt($this->tenant->registration_password), // Use the plain password passed from the event
            ]);

            // send welcome email to tenant admin
            try {
                $user->notify(
                    new TenantWelcomeNotification(
                        url: 'https://' . $domain,
                        password: $this->tenant->registration_password,
                    )
                );
            } finally {
                $this->tenant->registration_password = null;
                $this->tenant->save();
            }
        });
    }
}
