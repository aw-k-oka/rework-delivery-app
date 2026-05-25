<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('shipment.search.index');
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
        $user = Auth::user();

        return view('shipment.search.result', [
            // 未ログインの場合、返却情報は最小限にする
            'shipment' => $user ? [
                'id' => $shipment->id,
                'tracking_number' => $shipment->tracking_number,
                'status' => $shipment->status,
                'staff_name' => $shipment->staff_name,
                'client_name' => $shipment->client_name,
                'client_address' => $shipment->client_address,
                'receiver_name' => $shipment->receiver_name,
                'receiver_address' => $shipment->receiver_address,
            ] : [
                'tracking_number' => $shipment->tracking_number,
                'status' => $shipment->status,
            ],
            'user' => $user ? [
                'id' => $user->id,
                'user_name' => $user->name,
            ] : [],
        ]);
    }
}
