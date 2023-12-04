import './bootstrap';

import {delegate} from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'tippy.js/animations/shift-toward-subtle.css';
import './sweetAlert2.js'
import './bootstrap.js'
// Default configuration for Tippy with event delegation (https://atomiks.github.io/tippyjs/v6/addons/#event-delegation
delegate('body', {
    interactive: true,
    allowHTML: true,
    animation: 'shift-toward-subtle',
    target: '[data-tippy-content]',
});
