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
                    <audio controls style="width: 100%; max-width: 600px">
                        <source src="{{ asset('storage/songs/'. $song->file_audio_path)}}" type="audio/mpeg">
                    Your browser does not support the audio element.
                    </audio>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>