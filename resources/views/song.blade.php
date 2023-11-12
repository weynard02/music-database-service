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
                        </div>
                        
                        <button id="replay-{{$song->id}}" type="button" onclick="replay({{$song->id}})" class="mx-3 text-black bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                            <i data-feather="skip-back"></i>
                        </button>

                        <button id="button-{{$song->id}}" type="button" onclick="toggle({{$song->id}})" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            <i data-feather="pause"></i>
                        </button>
                        <audio autoplay id="audio-{{$song->id}}">
                            <source src="{{ asset('storage/songs/'. $song->file_audio_path)}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio>
                        <progress id="progressBar-{{$song->id}}" value="0" max="100" class="w-full h-4 bg-gray-300 rounded-full overflow-hidden"></progress>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/audio.js"></script>
    <script>
        progressBarUpdate({{ $song->id }});
    </script>
</x-app-layout>