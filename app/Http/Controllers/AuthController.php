<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    protected $auth0 = null;

    public function __construct()
    {
        $this->auth0 = new \Auth0\SDK\Auth0([
            'domain' => env('AUTH0_DOMAIN'),
            'clientId' => env('AUTH0_CLIENT_ID'),
            'clientSecret' => env('AUTH0_CLIENT_SECRET'),
            'cookieSecret' => env('AUTH0_COOKIE_SECRET')
        ]);
    }

    public function login()
    {
        if(App::environment('local'))
        {
            Auth::login(User::find('9badd341-b5d2-4c47-9d56-68baf4a21ac4'));

            return redirect('/');
        }

        $this->auth0->clear();

        return redirect($this->auth0->login(route('auth.callback')));
    }

    public function logout()
    {
        Auth::logout();

        return redirect($this->auth0->logout(url('/')));
    }

    public function callback()
    {
        $this->auth0->exchange(route('auth.callback'));

        try
        {
            $session = $this->auth0->getCredentials();

            if($session === null)
                return redirect('auth.login');

            $auth0_user = $session->user;

            $university = University::query()
                ->firstWhere(
                    'domain',
                    'like',
                    explode('@', $auth0_user['email'])[1] ?? ''
                );

            if(is_null($university))
                return redirect(route('auth.denied'));

            $user = User::query()
                ->firstOrCreate([
                    'email' => $auth0_user['email']
                ], [
                    'name' => $auth0_user['name'],
                    'password' => Hash::make('Password@123456'),
                    'university_id' => $university->id
                ]);

            $user->update([
                'auth0' => $auth0_user
            ]);

            Auth::login($user);
        }
        catch (Throwable $exception)
        {
            report($exception);

            return false;
        }

        return redirect(url('/'));
    }

    public function denied()
    {
        return view('auth.denied');
    }
}
