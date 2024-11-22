<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

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
        $qrCodesPath = storage_path('app/public/images/qr_codes');

        if (!File::exists($qrCodesPath)) {
            File::makeDirectory($qrCodesPath, 0755, true);
        }

    }
}
