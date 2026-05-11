<?php

namespace App\Http\Controllers;

class TopController extends Controller
{
    public function index()
    {
        $title = 'ゲストさん、ようこそ！';

        return view('top', [
            'title' => $title,
        ]);
    }
}
