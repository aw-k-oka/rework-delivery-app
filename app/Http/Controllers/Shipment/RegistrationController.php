<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipment\StoreShipmentRequest;
use App\Models\Shipment;
use Illuminate\View\View;

/**
 * 配送依頼に関する処理を行うコントローラー
 */
class RegistrationController extends Controller
{
    /**
     * ページ表示
     * @return View 配送依頼入力画面
     */
    public function index(): View
    {
        return view('shipment.registration.index');
    }

    /**
     * 依頼確認画面を表示
     * @param StoreShipmentRequest $request バリデーション済みリクエスト
     * @return View 依頼確認画面
     */
    public function confirm(StoreShipmentRequest $request): View
    {
        return view('shipment.registration.confirm', [
            'clientName' => $request->client_name,
            'clientAddress' => $request->client_address,
            'receiverName' => $request->receiver_name,
            'receiverAddress' => $request->receiver_address,
        ]);
    }

    /**
     * 配送データをDBに登録
     * @param StoreShipmentRequest $request バリデーション済みリクエスト
     * @return View 登録完了画面
     */
    public function store(StoreShipmentRequest $request): View
    {
        $shipment = Shipment::create([
            'client_name' => $request->client_name,
            'client_address' => $request->client_address,
            'receiver_name' => $request->receiver_name,
            'receiver_address' => $request->receiver_address,
            'status' => Shipment::STATUS_OFFICE,
        ]);

        $shipment->generateTrackingNumber();
        $shipment->save();

        return view('shipment.registration.complete', [
            'trackingNumber' => $shipment->tracking_number,
        ]);
    }
}
