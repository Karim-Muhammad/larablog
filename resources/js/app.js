import "./bootstrap";
import "./script";

// Styles
import "../../node_modules/choices.js/public/assets/styles/base.min.css";
import "../../node_modules/choices.js/public/assets/styles/choices.min.css";

// ===================== Alpine.js =====================
import Alpine from "alpinejs";
window.Alpine = Alpine;

Alpine.start();
