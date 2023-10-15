<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Discover') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid-cols-2 sm:grid md:grid-cols-4 ">
                @foreach ($songs as $i)
                <div
                  class="mx-3 mt-6 flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 sm:shrink-0 sm:grow sm:basis-0">
                    @if ($i->thumbnail_path)
                    <img src="{{ asset('storage/thumbnails/' . $i->thumbnail_path) }}" class="rounded-t-lg" alt="Thumbnail not uploaded">
                    @else
                        <img src="{{ asset('default_thumbnail.jpeg') }}" class="rounded-t-lg">
                    @endif
                  <div class="p-6">
                    <h5
                      class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                      {{ $i->title }}
                    </h5>
                    <h6 class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                        {{ $i->artist->name }}, {{ $i->release_date }}
                    </h6>
                    <audio controls style="width: 100%; max-width: 600px">
                        <source src="{{ asset('storage/songs/'. $i->file_audio_path)}}" type="audio/mpeg">
                    Your browser does not support the audio element.
                    </audio>
                    <h6 class="mb-4 text-base text-neutral-600 dark:text-neutral-200">Tags: </h6>
                    <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">{{ $i->tags }}</p>
                  </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
