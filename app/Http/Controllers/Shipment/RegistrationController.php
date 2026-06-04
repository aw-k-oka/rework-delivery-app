<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipment\StoreShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * 配送依頼に関する処理を行うコントローラー
 */
class RegistrationController extends Controller
{
    /** 配送情報のセッションキー */
    private const SHIPMENT_DATA = 'shipmentData';
    /** 完了した追跡番号のセッションキー */
    private const COMPLETED_TRACKING_NUMBER = 'completedTrackingNumber';

    /**
     * 依頼入力画面を表示
     * @return RedirectResponse|View 配送依頼入力画面
     */
    public function index(): RedirectResponse|View
    {
        if (!Auth::guard('customer')->check() && !Auth::guard('deliverer')->check()) {
            return redirect()->route('customer.login');
        }
        if (Auth::guard('deliverer')->check()) {
            return redirect()->route('shipment.search.index');
        }

        // 前回の依頼情報のセッションをクリア
        session()->forget([self::SHIPMENT_DATA, self::COMPLETED_TRACKING_NUMBER]);

        return view('shipment.registration.index', [
            'maxNameLength' => StoreShipmentRequest::MAX_NAME_LENGTH,
            'maxAddressLength' => StoreShipmentRequest::MAX_ADDRESS_LENGTH,
            'oldData' => [
                "client_name" => old("client_name", request("client_name")),
                "client_address" => old("client_address", request("client_address")),
                "receiver_name" => old("receiver_name", request("receiver_name")),
                "receiver_address" => old("receiver_address", request("receiver_address")),
            ],
        ]);
    }

    /**
     * 依頼確認画面を表示
     * @param StoreShipmentRequest $request バリデーション済みリクエスト
     * @return View 依頼確認画面
     */
    public function confirm(StoreShipmentRequest $request): View
    {
        $shipmentData = $request->validated();
        session([self::SHIPMENT_DATA => $shipmentData]);

        return view('shipment.registration.confirm', $shipmentData);
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
        $shipmentData['customer_id'] = Auth::guard('customer')->id();
        $shipment = Shipment::create($shipmentData);
        $shipment->generateTrackingNumber();
        $shipment->save();

        session([self::COMPLETED_TRACKING_NUMBER => $shipment->tracking_number]);
        return redirect()->route('shipment.registration.complete');
    }

    /**
     * 登録完了画面を表示
     * @return View 登録完了画面
     */
    public function complete(): View
    {
        $trackingNumber = session(self::COMPLETED_TRACKING_NUMBER);

        if (!$trackingNumber) {
            abort(403);
        }

        return view('shipment.registration.complete', [
            'trackingNumber' => $trackingNumber,
        ]);
    }
}
