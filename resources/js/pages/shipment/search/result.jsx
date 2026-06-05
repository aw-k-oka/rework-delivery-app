import React from "react";
import ReactDOM from "react-dom/client";

import ShipmentInfo from "../../../components/search/ShipmentInfo";
import ShipmentStatusActions from "../../../components/search/ShipmentStatusActions";

/**
 * JSONから情報を取得
 * @param {string|null|undefined} value
 * @returns {Object|null}
 */
const parseData = (value) => {
    return value ? JSON.parse(value) : null;
};

const element = document.getElementById("search-result");
if (element) {
    const data = element.dataset;
    // ViteのHot Reloadによるエラー対策で使い回している
    const root = window.searchResultRoot ?? ReactDOM.createRoot(element);
    window.searchResultRoot = root;

    root.render(
        <SearchResultPage
            shipment={parseData(data.shipment)}
            user={parseData(data.user)}
            backUrl={data.backUrl}
            returnUrl={data.returnUrl}
            deliverUrl={data.deliverUrl}
            completeUrl={data.completeUrl}
            csrfToken={data.csrfToken}
        />,
    );
}

/**
 * 検索結果の詳細表示
 * @param {Object} shipment 配送情報
 * @param {Object|null} user 担当者。顧客の場合はnull
 * @param {string} backUrl 戻るボタン用URL
 * @param {string} returnUrl 持ち帰りボタンの非同期通信用URL
 * @param {string} deliverUrl 配送ボタンの非同期通信用URL
 * @param {string} completeUrl 配達済みボタンの非同期通信用URL
 * @param {string} csrfToken
 * @returns {React.JSX.Element}
 */
function SearchResultPage({
    shipment,
    user,
    backUrl,
    returnUrl,
    deliverUrl,
    completeUrl,
    csrfToken,
}) {
    const [shipmentData, setShipmentData] = React.useState(shipment);
    return (
        <>
            <ShipmentInfo shipment={shipmentData} />
            <ShipmentStatusActions
                shipment={shipmentData}
                user={user}
                backUrl={backUrl}
                returnUrl={returnUrl}
                deliverUrl={deliverUrl}
                completeUrl={completeUrl}
                csrfToken={csrfToken}
                setShipmentData={setShipmentData}
            />
        </>
    );
}
