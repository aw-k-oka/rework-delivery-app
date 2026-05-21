<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipment\StoreShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * 配送依頼に関する処理を行うコントローラー
 */
class RegistrationController extends Controller
{
    /** セッションのキー */
    private const SHIPMENT_DATA = 'shipmentData';
    private const COMPLETED_TRACKING_NUMBER = 'completedTrackingNumber';

    /**
     * ページ表示
     * @return View 配送依頼入力画面
     */
    public function index(): View
    {
        // 前回の依頼情報のセッションをクリア
        session()->forget([self::SHIPMENT_DATA, self::COMPLETED_TRACKING_NUMBER]);

        return view('shipment.registration.index');
    }

    /**
     * 依頼確認画面を表示
     * @param StoreShipmentRequest $request バリデーション済みリクエスト
     * @return View 依頼確認画面
     */
    public function confirm(StoreShipmentRequest $request): View
    {
        session([self::SHIPMENT_DATA => $request->validated()]);

        return view('shipment.registration.confirm', [
            'clientName' => $request->client_name,
            'clientAddress' => $request->client_address,
            'receiverName' => $request->receiver_name,
            'receiverAddress' => $request->receiver_address,
        ]);
    }

    /**
     * 配送データをDBに登録
     * @return RedirectResponse 登録完了画面へリダイレクト
     */
    public function store(): RedirectResponse
    {
        // 配送データを登録
        $shipmentData = session(self::SHIPMENT_DATA);
        if (!$shipmentData) {
            abort(403);
        }
        $shipmentData['status'] = Shipment::STATUS_OFFICE;
        $shipment = Shipment::create($shipmentData);
        $shipment->generateTrackingNumber();
        $shipment->save();

        session([self::COMPLETED_TRACKING_NUMBER => $shipment->tracking_number]);
        return redirect()->route('shipment.registration.complete');
    }

    /**
     * 登録完了画面を表示
     * @return View 登録完了画面または入力画面へリダイレクト
     */
    public function complete(): View
    {
        $trackingNumber = session(self::COMPLETED_TRACKING_NUMBER);

        if (!$trackingNumber) {
            abort(403);
        }

        return view('shipment.registration.complete', compact('trackingNumber'));
    }
}
