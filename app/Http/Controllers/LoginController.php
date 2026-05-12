<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'ログイン画面';

        return view('login', [
            'title' => $title,
        ]);
    }

    /**
     * ログイン処理
     * @param Request $request POSTで送られるリクエスト
     */
    public function login(Request $request)
    {
        $credentials = [
            'login_id' => $request->login_id,
            'password' => $request->login_password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/search');
        }
        return back()->withErrors([
            'login_error' => 'ログインIDまたはパスワードが違います。',
        ]);
    }

    /**
     * ログアウト処理
     * @param Request $request POSTで送られるリクエスト
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
