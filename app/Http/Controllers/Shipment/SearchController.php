<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\JsonResponse;
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
     * @param Request $request GETリクエスト
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = Shipment::query();
        if ($request->tracking_number) {
            $query->where('tracking_number', 'like', '%' . $request->tracking_number . '%');
        }
        if ($request->receiver_address) {
            $query->where('receiver_address', 'like', '%' . $request->receiver_address . '%');
        }
        $shipments = $query->with('staff')->get();

        return response()->json($shipments->map(function ($shipment) {
            return [
                'tracking_number' => $shipment->tracking_number,
                'status' => $shipment->status,
                'staff_name' => $shipment->staff?->name,
                'receiver_name' => $shipment->receiver_name,
                'receiver_address' => $shipment->receiver_address,
            ];
        }));
    }

    /**
     * 検索結果表示
     * @param Request $request POSTで送られるリクエスト
     * @return View|RedirectResponse
     */
    public function result(Request $request): View|RedirectResponse
    {
        $shipment = Shipment::with('staff')->firstWhere('tracking_number', $request->tracking_number);

        if (!$shipment) {
            return back()->withErrors(['not_found_error' => '該当する配送情報が見つかりません。']);
        }
        // ログイン有無で共通の情報
        $shipmentData = [
            'tracking_number' => $shipment->tracking_number,
            'status' => $shipment->status,
        ];
        $user = Auth::user();
        // 担当者ログイン時に必要な情報
        if ($user) {
            $shipmentData = array_merge($shipmentData, [
                'id' => $shipment->id,
                'staff_id' => $shipment->staff_id,
                'staff_name' => $shipment->staff?->name,
                'client_name' => $shipment->client_name,
                'client_address' => $shipment->client_address,
                'receiver_name' => $shipment->receiver_name,
                'receiver_address' => $shipment->receiver_address,
            ]);
        }

        return view('shipment.search.result', [
            'shipment' => $shipmentData,
            'user' => $user ? [
                'id' => $user->id
            ] : null,
        ]);
    }
}
