<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * ステータス変更失敗時の文言
     */
    private const ERROR_MESSAGE = 'ステータス変更できません。配送情報が参照できないか、担当者が違います。';

    /**
     * 荷物ステータスを配送中に変更
     * @param Request $request POSTで送られるリクエスト
     * @return JSONResponse
     */
    public function deliver(Request $request): JSONResponse
    {
        $shipment = Shipment::find($request->id);
        if (!$shipment || !$shipment->canStartDelivery()) {
            return response()->json([
                'message' => self::ERROR_MESSAGE
            ], 400);
        }
        $shipment->startDelivery(Auth::id());
        $shipment->save();

        return $this->changeShipmentState($shipment);
    }

    /**
     * 荷物を持ち帰り、ステータスを営業所に戻す
     * @param Request $request POSTで送られるリクエスト
     * @return JSONResponse
     */
    public function backToOffice(Request $request): JSONResponse
    {
        $shipment = Shipment::find($request->id);
        if (!$shipment || !$shipment->canChangeStatus(Auth::id())) {
            return response()->json([
                'message' => self::ERROR_MESSAGE
            ], 400);
        }
        $shipment->returnToOffice();
        $shipment->save();

        return $this->changeShipmentState($shipment);
    }

    /**
     * 荷物を配達完了ステータスに変更
     * @param Request $request POSTで送られるリクエスト
     * @return JSONResponse
     */
    public function complete(Request $request): JSONResponse
    {
        $shipment = Shipment::find($request->id);
        if (!$shipment || !$shipment->canChangeStatus(Auth::id())) {
            return response()->json([
                'message' => self::ERROR_MESSAGE
            ], 400);
        }
        $shipment->completeDelivery();
        $shipment->save();

        return $this->changeShipmentState($shipment);
    }

    /**
     * 配送ステータスを変更
     * @param Shipment $shipment 配送情報
     * @return JSONResponse 変更後の配送情報
     */
    private function changeShipmentState(Shipment $shipment): JSONResponse
    {
        $shipment->load('staff');

        return response()->json([
            'id' => $shipment->id,
            'tracking_number' => $shipment->tracking_number,
            'status' => $shipment->status,
            'staff_id' => $shipment->staff_id,
            'staff_name' => $shipment->staff?->name,
            'client_name' => $shipment->client_name,
            'client_address' => $shipment->client_address,
            'receiver_name' => $shipment->receiver_name,
            'receiver_address' => $shipment->receiver_address,
        ]);
    }
}
