<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\Responses;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'response' => Responses::class,
            'question' => Question::class,
        ]);
    }
}
