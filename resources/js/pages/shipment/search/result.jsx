import React from "react";
import ReactDOM from "react-dom/client";

import ShipmentInfo from "../../../components/search/ShipmentInfo";
import ShipmentStatusActions from "../../../components/search/ShipmentStatusActions";

/**
 * JSONから情報を取得
 * @param {*} value
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
            <ShipmentInfo shipment={shipmentData} user={user} />
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
