import * as bootstrap from 'bootstrap';
import './bootstrap';

import '@fortawesome/fontawesome-free/js/all.min.js';

// Sempre in resources/js/app.js
document.addEventListener('DOMContentLoaded', function () {
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});
