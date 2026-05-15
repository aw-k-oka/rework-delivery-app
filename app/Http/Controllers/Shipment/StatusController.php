<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
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
        if (!$shipment || !$shipment->canStartDelivery()) {
            return back();
        }
        $shipment->startDelivery(Auth::user()->name);
        $shipment->save();

        return $this->redirectToSearchResult($shipment);
    }

    /**
     * 荷物を持ち帰り、ステータスを営業所に戻す
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse 配送情報検索結果画面へリダイレクト
     */
    public function backToOffice(Request $request): RedirectResponse
    {
        $shipment = Shipment::find($request->id);
        if (!$shipment || !$shipment->canChangeStatus(Auth::user()->name)) {
            return back();
        }
        $shipment->returnToOffice();
        $shipment->save();

        return $this->redirectToSearchResult($shipment);
    }

    /**
     * 荷物を配達完了ステータスに変更
     * @param Request $request POSTで送られるリクエスト
     * @return RedirectResponse 配送情報検索結果画面へリダイレクト
     */
    public function complete(Request $request): RedirectResponse
    {
        $shipment = Shipment::find($request->id);
        if (!$shipment || !$shipment->canChangeStatus(Auth::user()->name)) {
            return back();
        }
        $shipment->completeDelivery();
        $shipment->save();

        return $this->redirectToSearchResult($shipment);
    }

    /**
     * 検索結果画面へリダイレクト
     * @param Shipment $shipment 配送情報
     * @return RedirectResponse
     */
    private function redirectToSearchResult(Shipment $shipment): RedirectResponse
    {
        return redirect()->route('shipment.search.result', ['tracking_number' => $shipment->tracking_number]);
    }
}
