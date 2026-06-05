<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 配送情報モデル
 */
class Shipment extends Model
{
    /**
     * 配送ステータス
     */
    public const STATUS_OFFICE = '営業所';
    public const STATUS_DELIVERING = '配送中';
    public const STATUS_COMPLETED = '配達済み';

    /**
     * 配送番号の桁数
     */
    public const TRACKING_NUMBER_DIGITS = 6;

    /**
     * 一括代入許可カラム
     */
    protected $fillable = [
        'tracking_number',
        'staff_id',
        'client_name',
        'client_address',
        'receiver_name',
        'receiver_address',
        'status',
        'customer_id',
    ];

    /**
     * 外部キーを紐付け
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * 外部キーを紐付け
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * 配送番号をIDから自動生成して設定
     */
    public function generateTrackingNumber(): void
    {
        $this->tracking_number = str_pad($this->id, self::TRACKING_NUMBER_DIGITS, '0', STR_PAD_LEFT);
    }

    /**
     * 配送開始可能か
     * @return bool
     */
    public function canStartDelivery(): bool
    {
        return $this->status === self::STATUS_OFFICE;
    }

    /**
     * ステータス変更可能か
     * @param int $staffId 担当者ID
     * @return bool
     */
    public function canChangeStatus(int $staffId): bool
    {
        return $this->status === self::STATUS_DELIVERING && $this->staff_id === $staffId;
    }

    /**
     * 荷物を配送中ステータスに変更
     * @param int $staffId 担当者ID
     */
    public function startDelivery(int $staffId): void
    {
        $this->status = self::STATUS_DELIVERING;
        $this->staff_id = $staffId;
    }

    /**
     * 荷物を持ち帰り、営業所ステータスに変更
     */
    public function returnToOffice(): void
    {
        $this->status = self::STATUS_OFFICE;
        $this->staff_id = null;
    }

    /**
     * 荷物を配達完了ステータスに変更
     */
    public function completeDelivery(): void
    {
        $this->status = self::STATUS_COMPLETED;
    }
}
