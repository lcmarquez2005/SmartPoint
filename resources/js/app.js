
// Si tienes un archivo bootstrap.js con configuraciones, lo sigues importando
import './bootstrap';

// Importamos Bootstrap y Popper.js
import 'bootstrap'; // Esto importará tanto el CSS como el JS de Bootstrap (sin conflictos con tu configuración)
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
