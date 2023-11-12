<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Discover') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="/songs" method="GET">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" name="song" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." required>
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">{{ session('success') }}</div>
             @endif
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
                    
                    <div class="flex flex-row gap-4">
                        <a href="/songs/{{ $i->id }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                            Listen
                        </a> 
                        <a href="/songs/fav/{{$i->id}}" class="mt-2 text-white">
                            {{-- Checking if the pivot data exist or not or if it exists, is it favorite or not --}}
                            @php
                                $pivot =  $songUser->where('user_id', Auth::user()->id)->where('song_id',$i->id)->first()
                            @endphp
                            @if( $pivot && $pivot->is_favourite == true)
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53L12 21.35Z"/></svg>
                            @else
                                <i data-feather="heart"></i>
                            @endif
                        </a>
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
