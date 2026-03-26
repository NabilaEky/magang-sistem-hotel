<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(
                Str::lower($request->input(Fortify::username())) . '|' . $request->ip()
            );

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        /**
         * ============================
         * LOGIN REDIRECT BY ROLE
         * ============================
         */
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                public function toResponse($request)
                {
                    session()->forget('login_role'); // 🔥 hapus setelah login

                    $user = auth()->user();

                    if ($user->hasRole('super_admin')) {
                        return redirect('/super-admin/dashboard');
                    }

                    if ($user->hasRole('admin')) {
                        return redirect('/admin/dashboard');
                    }

                    if ($user->hasRole('petugas_eng')) {
                        return redirect('/petugas/dashboard');
                    }

                    if ($user->hasRole('dept')) {
                        return redirect('/dept/dashboard');
                    }

                    return redirect('/customer/dashboard');
                }
            };
        });


        Fortify::authenticateUsing(function (Request $request) {

            $user = \App\Models\User::where('username', $request->username)->first();

            if (
                $user &&
                \Illuminate\Support\Facades\Hash::check($request->password, $user->password)
            ) {

                $loginRole = session('login_role');
                if ($loginRole && !$user->hasRole($loginRole)) {
                    return null;
                }

                // 🔥 UPDATE LAST LOGIN
                $user->update([
                    'last_login_at' => now(),
                ]);

                return $user;
            }

            return null;
        });

        /**
         * ============================
         * LOGOUT REDIRECT
         * ============================
         */
        $this->app->singleton(LogoutResponse::class, function () {
            return new class implements LogoutResponse {
                public function toResponse($request)
                {
                    $user = $request->user(); // lebih proper

                    session()->forget('login_role');

                    if ($user?->hasRole('super_admin')) {
                        return redirect('/super-admin/login');
                    }

                    if ($user?->hasRole('admin')) {
                        return redirect('/admin/login');
                    }

                    if ($user?->hasRole('petugas_eng')) {
                        return redirect('/petugas/login');
                    }

                    if ($user?->hasRole('dept')) {
                        return redirect('/dept/login');
                    }

                    return redirect('/login');
                }
            };
        });
    }
}
