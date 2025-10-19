<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ログイン認証処理
        Fortify::authenticateUsing(function (Request $request) {
            // LoginRequestのルールを利用して手動バリデーション
            $form = app(LoginRequest::class);
            $form->setContainer(app())->setRedirector(app('redirect'));
            $form->merge($request->all());
            Log::info($form->all());

            $varidator = Validator::make(
                $form->all(),
                $form->rules(),
                $form->messages(),
                $form->attributes()
            );

            if ($varidator->fails()) {
                Log::info('Auth validation failed');
                throw ValidationException::withMessages($varidator->errors()->toArray());
            }
            $validated = $varidator->validate();

            $user = User::where('email', $validated['email'])->first();
            if ($user && Hash::check($validated['password'], $user->password)) {
                Log::info('Auth success');
                return $user;
            }

            return null;
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });

        // ログアウト後のリダイレクト先を明示的に設定
        $this->app->bind(
            \Laravel\Fortify\Contracts\LogoutResponse::class,
            function () {
                return new class implements \Laravel\Fortify\Contracts\LogoutResponse {
                    public function toResponse($request)
                    {
                        return redirect('/login'); // ログアウト時は/loginに遷移
                    }
                };
            }
        );
    }
}
