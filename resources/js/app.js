import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function play(id) {
    var x = document.getElementById("audio-" + id);
    x.play();
}
function pause(id) {
    var x = document.getElementById("audio-" + id);
    x.pause();
}
