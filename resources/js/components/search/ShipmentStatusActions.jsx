// 配送ステータス
const STATUS_OFFICE = "営業所";
const STATUS_DELIVERING = "配送中";

/**
 * 配送ステータス変更
 * @param {Object} shipment 配送情報
 * @param {Object} user 担当者
 * @param {string} backUrl 戻るURL
 * @param {string} deliverUrl 配送ボタンの非同期通信用URL
 * @param {string} returnUrl 持ち帰りボタンの非同期通信用URL
 * @param {string} completeUrl 配達済みボタンの非同期通信用URL
 * @param {string} csrfToken
 * @param {Function} setShipmentData 配送ステータス更新関数
 * @returns {React.JSX.Element}
 */
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
                console.error(data.message);
                return;
            }
            setShipmentData(data);
        } catch (e) {
            console.error(e.message);
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

/**
 * ステータス変更ボタン
 * @param {Function} onClick クリック時に発火する関数
 * @param {boolean} disabledFlg ボタンの押下可否
 * @param {string} label ボタン名称
 * @returns {React.JSX.Element}
 */
function StatusButton({ onClick, disabledFlg, label }) {
    return (
        <button type="button" onClick={onClick} disabled={disabledFlg}>{label}</button>
    );
}
