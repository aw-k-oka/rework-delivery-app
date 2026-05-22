import StatusButtonForm from './StatusButtonForm';

/**
 * 配送ステータス
 */
const STATUS_OFFICE = '営業所';
const STATUS_DELIVERING = '配送中';

export default function ShipmentStatusActions({ shipment, user, backUrl , deliverUrl, returnUrl, completeUrl, isAnotherStaff, csrfToken }) {
    const IS_OFFICE = shipment.status === STATUS_OFFICE;
    const IS_DELIVERING = shipment.status === STATUS_DELIVERING;

    return (
        <div className="button-area">
            <form action={backUrl} method="GET">
                <button type="submit" className="short-word">戻る</button>
            </form>
            {user && IS_OFFICE && (
            <StatusButtonForm action={deliverUrl} formClass='delivery-form' csrfToken={csrfToken} shipmentId={shipment.id} buttonClass='status-button short-word' label='配送' />
            )}
            {user && IS_DELIVERING && (
            <StatusButtonForm action={returnUrl} formClass='return-form' csrfToken={csrfToken} shipmentId={shipment.id} buttonClass='status-button' disabledFlg={isAnotherStaff} label='持ち帰り' />
            )}
            {user && IS_DELIVERING && (
            <StatusButtonForm action={completeUrl} formClass='complete-form' csrfToken={csrfToken} shipmentId={shipment.id} buttonClass='status-button' disabledFlg={isAnotherStaff} label='配達済み' />
            )}
        </div>
    );
}
