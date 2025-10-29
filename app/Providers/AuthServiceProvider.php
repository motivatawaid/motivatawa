<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Ticket;
use App\Models\User;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    private static $permissions = [
        // buat role permission disini
        // tambahkan superadmin jika diperlukan
        // 'admin' => ['admin'],
        'talent' => ['talent'],
        'user' => ['user'],
    ];

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // aktifkan ini jika ingin superadmin bisa semua role (syarat: superadmin tidak usah di tambahkan dirole permission)
        Gate::before(function (User $user) {
            if ($user->role === 'admin') {
                return true;
            }
        });

        foreach (self::$permissions as $action => $roles) {
            Gate::define($action, function (User $user) use ($roles) {
                if (in_array($user->role, $roles)) {
                    return true;
                }
            });
        }

        $this->registerPolicies();
    }
}
