import './bootstrap';
import intersect from '@alpinejs/intersect';

document.addEventListener('alpine:init', () => {
    window.Alpine.plugin(intersect);
});
