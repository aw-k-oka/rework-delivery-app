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
     * 担当者ログイン画面を表示
     * @return RedirectResponse|View ログイン画面
     */
    public function staffIndex(): RedirectResponse|View
    {
        if (Auth::guard('staff')->check()) {
            return redirect()->route('shipment.search.index');
        }
        return view('auth.login');
    }

    /**
     * 顧客ログイン画面を表示
     * @return RedirectResponse|View ログイン画面
     */
    public function customerIndex(): RedirectResponse|View
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.top');
        }
        return view('auth.customerLogin');
    }

    /**
     * 担当者ログイン処理
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse
     */
    public function staffLogin(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        $credentials = [
            'login_id' => $request->login_id,
            'password' => $request->login_password,
        ];

        if (Auth::guard('staff')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('shipment.search.index');
        }
        return back()->withErrors(['login_error' => 'ログインIDまたはパスワードが違います。'])->withInput();
    }

    /**
     * 顧客ログイン処理
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse
     */
    public function customerLogin(Request $request): RedirectResponse
    {
        Auth::guard('staff')->logout();

        $credentials = [
            'login_id' => $request->login_id,
            'password' => $request->login_password,
        ];

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('customer.top');
        }
        return back()->withErrors(['login_error' => 'ログインIDまたはパスワードが違います。'])->withInput();
    }

    /**
     * ログアウト処理
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $formerLogin = '';
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
            $formerLogin = 'customer';
        } else {
            Auth::guard('staff')->logout();
            $formerLogin = 'staff';
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $formerLogin === 'staff' ? redirect()->route('staff.login') : redirect()-> route('customer.login');
    }
}
