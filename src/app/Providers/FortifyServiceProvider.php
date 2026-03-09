<?php

namespace App\Providers;

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(
            function () {
                return view('auth.register');
            }
        );

        Fortify::loginView(
            function () {
                return view('auth.login');
            }
        );

        RateLimiter::for(
            'login',
            function (Request $request) {
                $email = (string) $request->email;
                return Limit::perMinute(10)->by($email . $request->ip());
            }
        );

        Fortify::authenticateUsing(
            function (Request $request) {
                $user = User::where('email', $request->email)->first();

                if ($user && Hash::check($request->password, $user->password)) {
                    return $user;
                }

                throw ValidationException::withMessages([
                    'password' => ['ログイン情報が登録されていません'],
                ]);
            }
        );
    }

    public function register(): void
    {
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });
    }
}
