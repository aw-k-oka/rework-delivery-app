<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * 配送情報の検索に関する処理を行うコントローラー
 */
class SearchController extends Controller
{
    /**
     * ページ表示
     * @return View 配送情報検索画面
     */
    public function index(): View
    {
        return view('shipment.search.index', [
            'title' => '配送情報検索画面',
        ]);
    }

    /**
     * 検索結果表示
     * @param Request $request POSTで送られるリクエスト
     * @return View|RedirectResponse
     */
    public function result(Request $request): View|RedirectResponse
    {
        $shipment = Shipment::firstWhere('tracking_number', $request->tracking_number);

        if (!$shipment) {
            return back()->withErrors(['not_found_error' => '該当する配送情報が見つかりません。']);
        }

        return view('shipment.search.result', [
            'title' => '配送情報検索結果',
            'shipment' => $shipment,
        ]);
    }
}
