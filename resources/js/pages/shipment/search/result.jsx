import React from 'react';
import ReactDOM from 'react-dom/client';

import ShipmentStatusActions from '../../../components/search/ShipmentStatusActions';

const element = document.getElementById('shipment-status-actions');
if (element) {
    const data = element.dataset;
    const shipment = data.shipment ? JSON.parse(data.shipment) : null;
    const user = data.user ? JSON.parse(data.user) : null;

    ReactDOM.createRoot(element).render(
        <ShipmentStatusActions
            shipment={shipment}
            user={user}
            backUrl={data.backUrl}
            returnUrl={data.returnUrl}
            deliverUrl={data.deliverUrl}
            completeUrl={data.completeUrl}
            isAnotherStaff={user ? shipment.staff_name !== user.name : false}
            csrfToken={data.csrfToken}
        />
    );
}
