<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse|View ログイン画面
     */
    public function index(): RedirectResponse|View
    {
        if (Auth::check()) {
            return redirect()->route('shipment.search.index');
        }
        return view('auth.login');
    }

    /**
     * ログイン処理
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = [
            'login_id' => $request->login_id,
            'password' => $request->login_password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('shipment.search.index');
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
        return redirect()->route('login');
    }
}
