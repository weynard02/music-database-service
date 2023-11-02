function play(id) {
    console.log("play");
    var x = document.getElementById("audio-" + id);
    x.play();
}
function pause(id) {
    var x = document.getElementById("audio-" + id);
    x.pause();
}
