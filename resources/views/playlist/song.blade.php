<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $song->artist->name }} - {{ $song->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 space-y-6">
                        <div class="columns-2">
                            @if ($song->thumbnail_path)
                                <img src="{{ asset('storage/thumbnails/' . $song->thumbnail_path) }}" class="mx-3 w-56 h-auto max-w-lg rounded-lg" alt="Thumbnail not uploaded">
                            @else
                                <img src="{{ asset('default_thumbnail.jpeg') }}" class="mx-3 w-56 h-auto max-w-lg rounded-lg">
                            @endif
                            <h2
                            class="mb-2 text-3xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                {{ $song->title }}
                            </h2>
                            <h4 class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                {{ $song->artist->name }}
                            </h4>
                            <h5 class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                Genre: 
                                <p class="text-sm text-gray-900 dark:text-white">
                                    @foreach($song->genres as $genre) 
                                        <span class="capitalize">{{ $genre->name }}</span>, 
                                    @endforeach
                                </p>
                            </h5>
                            @if(Auth::user()->plan->name == 'admin' || Auth::user()->name == $song->artist->name)
                            <a href="/genres/add/{{$song->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Add Genres
                            </a>
                            @endif
                        </div>
                        
                        <button id="replay-{{$song->id}}" type="button" onclick="replay({{$song->id}})" class="mx-3 text-black bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                            <i data-feather="skip-back"></i>
                        </button>

                        <button id="button-{{$song->id}}" type="button" onclick="toggle({{$song->id}})" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            <i data-feather="pause"></i>
                        </button>
                        <button id="loop-{{$song->id}}" type="button" onclick="loop({{$song->id}})" class="mx-3 text-purple-700 hover:text-white border border-purple-700 rounded-full hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">
                            <i data-feather="repeat"></i>
                        </button>
                        
                        
                        <audio id="audio-{{$song->id}}">
                            <source src="{{ asset('storage/songs/'. $song->file_audio_path)}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio>
                        <input type="range" id="volume-slider-{{$song->id}}">
                        <progress id="progressBar-{{$song->id}}" value="0" max="100" class="w-full h-4 bg-gray-300 rounded-full overflow-hidden"></progress>
                        @if($nextSong)
                        <a href="/songs/{{$playlist->id}}/{{$nextSong->id}}" type="button" class="mx-3 text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Next
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/audio.js"></script>
    <script>
        progressBarUpdate({{ $song->id }});
        var audio = document.getElementById("audio-" + {{$song->id}});
        var volume = document.getElementById('volume-slider-'+{{$song->id}});
        volume.addEventListener("change", function(e) {
            audio.volume = e.currentTarget.value / 100;
        })
        window.onload = function () {
            audio.play();
            if (audio.paused || audio.duration == 0) {
                var p = document.getElementById("button-" + {{$song->id}});
                p.className =
                    "mx-3 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800";
                p.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>';
            }
        };
        
    </script>
</x-app-layout>