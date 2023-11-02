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
{{--                     
                    <a href="/songs/{{ $i->id }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                        Listen
                    </a> --}}
                    {{--  --}}
                    
                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal-{{ $i->id }}" data-modal-toggle="default-modal-{{ $i->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Listen
                    </button>
                    
                    <!-- Main modal -->
                    <div id="default-modal-{{ $i->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Enjoy!
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-{{ $i->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <div class="columns-2">
                                        @if ($i->thumbnail_path)
                                            <img src="{{ asset('storage/thumbnails/' . $i->thumbnail_path) }}" class="mx-3 w-56 h-auto max-w-lg rounded-lg" alt="Thumbnail not uploaded">
                                        @else
                                            <img src="{{ asset('default_thumbnail.jpeg') }}" class="mx-3 w-56 h-auto max-w-lg rounded-lg">
                                        @endif
                                        <h2
                                        class="mb-2 text-3xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                            {{ $i->title }}
                                        </h2>
                                        <h4 class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                            {{ $i->artist->name }}
                                        </h4>
                                    </div>
                                    <button type="button" onclick="play({{$i->id}})" class="mx-3 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <i data-feather="play"></i>
                                    </button>
                                    <button type="button" onclick="pause({{$i->id}})" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        <i data-feather="pause"></i>
                                    </button>
                                    <audio id="audio-{{$i->id}}">
                                        <source src="{{ asset('storage/songs/'. $i->file_audio_path)}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                    </audio>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="default-modal-{{ $i->id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go Back</button>
                                </div>
                            </div>
                        </div>
                    </div>
  
                    
                    <h6 class="mt-4 mb-4 text-base text-neutral-600 dark:text-neutral-200">{{ $i->streams }} streams</h6>
                    <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">{{ $i->tags }}</p>
                  </div>
                </div>
                @endforeach
                
            </div>
        </div>
        <div class="mt-4 flex justify-center">
            {{ $songs->links() }}
        </div>
    </div>
</x-app-layout>
