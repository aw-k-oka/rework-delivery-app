<?php

namespace App\Http\Controllers;

class SearchController extends Controller
{
    /**
     * ページ表示
     */
    public function index()
    {
        $title = '配送情報検索画面';

        return view('search', [
            'title' => $title,
        ]);
    }
}
