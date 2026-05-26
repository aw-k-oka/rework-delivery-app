import StatusButton from "./StatusButton";

/**
 * 配送ステータス
 */
const STATUS_OFFICE = "営業所";
const STATUS_DELIVERING = "配送中";

export default function ShipmentStatusActions({
    shipment,
    user,
    backUrl,
    deliverUrl,
    returnUrl,
    completeUrl,
    csrfToken,
    setShipmentData,
}) {
    const updateStatus = async (url) => {
        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    id: shipment.id,
                }),
            });
            const data = await response.json();
            if (!response.ok) {
                console.error(data);
                return;
            }
            setShipmentData(data);
        } catch (e) {
            console.error(e);
        }
    };

    const IS_OFFICE = shipment.status === STATUS_OFFICE;
    const IS_DELIVERING = shipment.status === STATUS_DELIVERING;
    const IS_ANOTHER_STAFF = user && shipment.staff_id !== user.id;

    return (
        <div className="button-area">
            <button
                type="button"
                onClick={() => (window.location.href = backUrl)}
            >
                戻る
            </button>
            {user && IS_OFFICE && (
                <>
                    <div className="button-placeholder"></div>
                    <StatusButton
                        onClick={() => updateStatus(deliverUrl)}
                        label="配送"
                    />
                </>
            )}
            {user && IS_DELIVERING && (
                <>
                    <StatusButton
                        onClick={() => updateStatus(returnUrl)}
                        disabledFlg={IS_ANOTHER_STAFF}
                        label="持ち帰り"
                    />
                    <StatusButton
                        onClick={() => updateStatus(completeUrl)}
                        disabledFlg={IS_ANOTHER_STAFF}
                        label="配達済み"
                    />
                </>
            )}
        </div>
    );
}
