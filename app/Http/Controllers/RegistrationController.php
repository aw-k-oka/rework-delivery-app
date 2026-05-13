<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * ページ表示
     */
    public function index()
    {
        $title = '配送依頼画面';

        return view('registration', [
            'title' => $title,
        ]);
    }

    /**
     * 依頼確認画面に遷移
     * @param Request $request POSTで送られるリクエスト
     */
    public function confirm(Request $request)
    {
        $request->validate(
            [
                'client_name' => ['required', 'max:30'],
                'client_address' => ['required', 'max:50'],
                'receiver_name' => ['required', 'max:30'],
                'receiver_address' => ['required', 'max:50'],
            ],
            [
                'client_name.required' => 'ご依頼主名は必須です。',
                'client_name.max' => 'ご依頼主名は30文字以内で入力してください。',
                'client_address.required' => 'ご依頼主住所は必須です。',
                'client_address.max' => 'ご依頼主住所は50文字以内で入力してください。',
                'receiver_name.required' => 'お届け先氏名は必須です。',
                'receiver_name.max' => 'お届け先氏名は30文字以内で入力してください。',
                'receiver_address.required' => 'お届け先住所は必須です。',
                'receiver_address.max' => 'お届け先住所は50文字以内で入力してください。',
            ]
        );
        return view('confirm', [
            'title' => '依頼確認画面',
            'clientName' => $request->client_name,
            'clientAddress' => $request->client_address,
            'receiverName' => $request->receiver_name,
            'receiverAddress' => $request->receiver_address,
        ]);
    }

    /**
     * 配送データをDBに登録
     * @param Request $request POSTで送られるリクエスト
     */
    public function store(Request $request)
    {
        $shipment = Shipment::create([
            'client_name' => $request->client_name,
            'client_address' => $request->client_address,
            'receiver_name' => $request->receiver_name,
            'receiver_address' => $request->receiver_address,
            'status' => '営業所',
        ]);

        $trackingNumber = str_pad($shipment->id, 6, '0', STR_PAD_LEFT);
        $shipment->tracking_number = $trackingNumber;
        $shipment->save();

        return view('complete', [
            'title' => '登録完了画面',
            'trackingNumber' => $shipment->tracking_number,
        ]);
    }
}
