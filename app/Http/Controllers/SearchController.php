<?php

namespace App\Http\Controllers;

use App\Models\Shipments;
use Illuminate\Http\Request;

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

    /**
     * 検索結果表示
     */
    public function result(Request $request)
    {
        $title = '配送情報検索結果';

        $shipment = Shipments::firstWhere('tracking_number', $request->tracking_number);

        if (!$shipment) {
            return back()->withErrors(['not_found_error' => '該当する配送情報が見つかりません。']);
        }

        return view('result', [
            'title' => $title,
            'shipment' => $shipment,
        ]);
    }
}
