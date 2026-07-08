import './bootstrap';

import Alpine from 'alpinejs';

// Mengekspos Alpine agar komponen Blade dapat memakai directive x-*.
window.Alpine = Alpine;

Alpine.start();
