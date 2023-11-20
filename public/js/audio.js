function toggle(id) {
    var audio = document.getElementById("audio-" + id);
    if (audio.paused || audio.duration == 0) {
        audio.play();
        var p = document.getElementById("button-" + id);
        p.className =
            "mx-3 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900";
        p.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause"><rect audio="6" y="4" width="4" height="16"></rect><rect audio="14" y="4" width="4" height="16"></rect></svg>';
    } else {
        audio.pause();
        var p = document.getElementById("button-" + id);
        p.className =
            "mx-3 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800";
        p.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>';
    }
}

function replay(id) {
    var audio = document.getElementById("audio-" + id);
    audio.currentTime = 0;
    audio.play();
}

function loop(id) {
    var audio = document.getElementById("audio-" + id);
    audio.loop = true;
    var p = document.getElementById("loop-" + id);
    if (
        p.className ==
        "mx-3 text-purple-700 hover:text-white border border-purple-700 rounded-full hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900"
    ) {
        p.className =
            "mx-3 text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900";
    } else {
        p.className =
            "mx-3 text-purple-700 hover:text-white border border-purple-700 rounded-full hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900";
    }
}

function progressBarUpdate(id) {
    var progressBar = document.getElementById("progressBar-" + id);
    var audio = document.getElementById("audio-" + id);

    audio.addEventListener("timeupdate", function () {
        progressBar.value = (audio.currentTime / audio.duration) * 100;
    });

    audio.addEventListener("ended", function () {
        audio.pause();
        var p = document.getElementById("button-" + id);
        p.className =
            "mx-3 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800";
        p.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>';
    });
}
