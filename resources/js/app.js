// import "./bootstrap";
import "flowbite";
import "./dark-mode.js";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";

window.Alpine = Alpine;

Alpine.plugin(focus);
Alpine.start();
