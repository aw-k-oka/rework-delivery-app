import React from 'react';
import ReactDOM from 'react-dom/client';

import Complete from '../../../components/Complete';

const element = document.getElementById('complete-message');

if (element) {
    const trackingNumber = element.dataset.trackingNumber;

    ReactDOM.createRoot(element).render(
        <Complete trackingNumber={trackingNumber} />
    );
}
