<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * ログインに関する処理を行うコントローラー
 */
class LoginController extends Controller
{
    /**
     * ログイン画面を表示
     * @return View ログイン画面
     */
    public function index(): View
    {
        return view('login', [
            'title' => 'ログイン画面',
        ]);
    }

    /**
     * ログイン処理
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse|Response
     */
    public function login(Request $request): RedirectResponse|Response
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
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
