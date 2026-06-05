<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * 顧客トップページに関する処理を行うコントローラー
 */
class TopController extends Controller
{
    /**
     * 顧客トップページを表示
     * @return RedirectResponse|View トップページ
     */
    public function index(): RedirectResponse|View
    {
        if (Auth::guard('staff')->check()) {
            return redirect()->route('shipment.search.index');
        }
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login');
        }
        return view('top');
    }
}
