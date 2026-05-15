<?php

namespace App\Http\Requests\Shipment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 配送データ登録リクエスト
 */
class StoreShipmentRequest extends FormRequest
{
    /**
     * 名前の最大文字数
     */
    public const MAX_NAME_LENGTH = 30;
    /**
     * 住所の最大文字数
     */
    public const MAX_ADDRESS_LENGTH = 50;

    /**
     * リクエスト認可
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルール
     * @return array バリデーションルールの配列
     */
    public function rules(): array
    {
        return [
            'client_name' => ['required', 'max:' . self::MAX_NAME_LENGTH],
            'client_address' => ['required', 'max:' . self::MAX_ADDRESS_LENGTH],
            'receiver_name' => ['required', 'max:' . self::MAX_NAME_LENGTH],
            'receiver_address' => ['required', 'max:' . self::MAX_ADDRESS_LENGTH],
        ];
    }

    /**
     * バリデーションエラーの属性名
     * @return array 属性名の配列
     */
    public function attributes(): array
    {
        return [
            'client_name' => 'ご依頼主名',
            'client_address' => 'ご依頼主住所',
            'receiver_name' => 'お届け先名',
            'receiver_address' => 'お届け先住所',
        ];
    }

    /**
     * バリデーションエラーメッセージ
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => ':attributeは必須項目です。',
            'max' => ':attributeは:max文字以内で入力してください。',
        ];
    }
}
