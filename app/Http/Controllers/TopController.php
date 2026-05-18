<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * 顧客トップページに関する処理を行うコントローラー
 */
class TopController extends Controller
{
    /**
     * トップページを表示
     * @return View トップページ
     */
    public function index(): View
    {
        return view('top');
    }
}
