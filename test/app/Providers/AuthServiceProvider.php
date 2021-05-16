<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use App\Policies\ProductPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PostPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Skipp Authorization for Admin
        Gate::before(function ($user, $ability) {
            if ($user->isAdministrator()) {
                return true;
            }
        });

        // Product 
        Gate::define('view-product', [ProductPolicy::class, 'view']);
        Gate::define('create-product', [ProductPolicy::class, 'create']);
        Gate::define('update-product', [ProductPolicy::class, 'update']);
        Gate::define('delete-product', [ProductPolicy::class, 'delete']);
        Gate::define('restore-product', [ProductPolicy::class, 'restore']);
        Gate::define('force-delete-product', [ProductPolicy::class, 'forceDelete']);

        // Order 
        Gate::define('view-order', [OrderPolicy::class, 'view']);
        Gate::define('create-order', [OrderPolicy::class, 'create']);
        Gate::define('update-order', [OrderPolicy::class, 'update']);
        Gate::define('delete-order', [OrderPolicy::class, 'delete']);
        Gate::define('restore-order', [OrderPolicy::class, 'restore']);
        Gate::define('force-delete-order', [OrderPolicy::class, 'forceDelete']);

        // Blog 
        Gate::define('view-post', [PostPolicy::class, 'view']);
        Gate::define('create-post', [PostPolicy::class, 'create']);
        Gate::define('update-post', [PostPolicy::class, 'update']);
        Gate::define('delete-post', [PostPolicy::class, 'delete']);
        Gate::define('restore-post', [PostPolicy::class, 'restore']);
        Gate::define('force-delete-post', [PostPolicy::class, 'forceDelete']);
    }

    
}
