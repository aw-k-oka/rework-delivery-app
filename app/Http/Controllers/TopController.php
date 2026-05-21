<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * 顧客トップページに関する処理を行うコントローラー
 */
class TopController extends Controller
{
    /**
     * 顧客トップページを表示
     * @return View トップページ
     */
    public function index(): View
    {
        if (Auth::check()) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        return view('top');
    }
}
