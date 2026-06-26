import { initLanyard } from './lanyard';

document.addEventListener('DOMContentLoaded', () => {
    const lanyardContainer = document.getElementById('lanyard-container');
    if (lanyardContainer) {
        initLanyard(lanyardContainer);
    }
});
