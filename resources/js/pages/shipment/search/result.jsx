import React from 'react';
import ReactDOM from 'react-dom/client';

import ShipmentInfo from '../../../components/search/ShipmentInfo'
import ShipmentStatusActions from '../../../components/search/ShipmentStatusActions';

/**
 * JSONから情報を取得
 * @param {*} value
 * @returns {Object|null}
 */
const parseData = (value) => {
    return value ? JSON.parse(value) : null;
}

const infoElement = document.getElementById('search-result');
if (infoElement) {
    const data = infoElement.dataset;
    const shipment = parseData(data.shipment);
    const user = parseData(data.user);
    ReactDOM.createRoot(infoElement).render(
        <ShipmentInfo
            shipment={shipment}
            user={user}
        />
    )
}

const actionElement = document.getElementById('shipment-status-actions');
if (actionElement) {
    const data = actionElement.dataset;
    const shipment = parseData(data.shipment);
    const user = parseData(data.user);
    const actionProps = user ? {
        returnUrl: data.returnUrl,
        deliverUrl: data.deliverUrl,
        completeUrl: data.completeUrl,
        csrfToken: data.csrfToken,
        isAnotherStaff: shipment && user ? shipment.staff_id !== user.id : false
    } : {};

    ReactDOM.createRoot(actionElement).render(
        <ShipmentStatusActions
            shipment={shipment}
            user={user}
            backUrl={data.backUrl}
            {...actionProps}
        />
    );
}
