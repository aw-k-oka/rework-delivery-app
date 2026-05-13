<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * 荷物ステータスを配送中に変更
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse 配送情報検索結果画面へリダイレクト
     */
    public function deliver(Request $request): RedirectResponse
    {
        $shipment = Shipment::find($request->id);
        // 不正な操作が行われた時は何もしない
        if (!$shipment || $shipment->status !== Shipment::STATUS_OFFICE) {
            return back();
        }
        $shipment->startDelivery(Auth::user()->name);

        return redirect('/search/result?tracking_number=' . $shipment->tracking_number);
    }

    /**
     * 荷物を持ち帰り、ステータスを営業所に戻す
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse 配送情報検索結果画面へリダイレクト
     */
    public function return(Request $request): RedirectResponse
    {
        $shipment = Shipment::find($request->id);
        // 不正な操作が行われた時は何もしない
        if (!$shipment || $shipment->status !== Shipment::STATUS_DELIVERING || $shipment->staff_name !== Auth::user()->name) {
            return back();
        }
        $shipment->returnToOffice();

        return back();
    }

    /**
     * 荷物を配達完了ステータスに変更
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse 配送情報検索結果画面へリダイレクト
     */
    public function complete(Request $request): RedirectResponse
    {
        $shipment = Shipment::find($request->id);
        // 不正な操作が行われた時は何もしない
        if (!$shipment || $shipment->status !== Shipment::STATUS_DELIVERING || $shipment->staff_name !== Auth::user()->name) {
            return back();
        }
        $shipment->completeDelivery();

        return back();
    }
}
