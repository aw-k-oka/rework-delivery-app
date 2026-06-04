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
     * @return RedirectResponse|View 配送情報検索画面
     */
    public function index(): RedirectResponse|View
    {
        if (!Auth::guard('customer')->check() && !Auth::guard('web')->check()) {
            return redirect()->route('customer.login');
        }
        return view('shipment.search.index');
    }

    /**
     * 検索結果表示
     * @param Request $request GETリクエスト
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        // URLに直接アクセスした場合は404エラーを返す
        if (!$request->expectsJson()) {
            abort(404);
        }
        $query = Shipment::query();

        if (Auth::guard('customer')->check()) {
            $query->where('customer_id', Auth::guard('customer')->id());
        }
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
                'updated_at' => $shipment->updated_at,
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
        if (!Auth::guard('customer')->check() && !Auth::guard('web')->check()) {
            return redirect()->route('customer.login');
        }

        $shipment = Shipment::with('staff')->firstWhere('tracking_number', $request->tracking_number);
        // 自身の依頼した配送情報しか閲覧できない
        if ($shipment->customer_id !== Auth::guard('customer')->id()) {
            abort(403);
        }
        $shipmentData = [
            'tracking_number' => $shipment->tracking_number,
            'status' => $shipment->status,
            'id' => $shipment->id,
            'staff_id' => $shipment->staff_id,
            'staff_name' => $shipment->staff?->name,
            'client_name' => $shipment->client_name,
            'client_address' => $shipment->client_address,
            'receiver_name' => $shipment->receiver_name,
            'receiver_address' => $shipment->receiver_address,
        ];
        $user = Auth::guard('web')->user();

        return view('shipment.search.result', [
            'shipment' => $shipmentData,
            'user' => $user ? [
                'id' => $user->id
            ] : null,
        ]);
    }
}
