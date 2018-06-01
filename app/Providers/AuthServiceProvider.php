<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\AclPermissionsModel;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        if ($_SERVER['PHP_SELF'] != 'artisan') {

            // busca todas as permissoes e as roles que possuem elas
            $acl_permissions = AclPermissionsModel::with('roles')->get();

            foreach ($acl_permissions as $permission) {
                // cria permissoes
                $gate->define($permission->name, function(User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }

        $gate->before(function(User $user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}
