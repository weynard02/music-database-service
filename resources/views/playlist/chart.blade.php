<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $playlist->name }} 
        </h2>
        @canany(['isAdmin', 'playlist-delete'], $playlist)
        <form action="/playlists/{{$playlist->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('delete')
            <button type="submit" class="mt-1 px-3 py-2 text-xs font-medium 
            text-red-700 hover:text-white border border-red-700 hover:bg-red-800 
            focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                Delete Playlist
            </button>
        </form>
        @endcanany
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg ">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">{{ session('success') }}</div>
                    @endif
                    @foreach($playlist->songs as $i) 
                        
                    <div class="my-4 max-w-3xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $loop->index + 1 }}. {{$i->artist->name}} - {{$i->title}}</h5>
                        
                        <a href="/songs/{{$playlist->id}}/{{$i->id}}" class="my-6 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Listen</a>

                        {{-- Checking if the pivot data exist or not or if it exists, is it favorite or not --}}
                        @php
                            $pivot =  $playlistSong->where('song_id',$i->id)->first();
                        @endphp
                        <h5 class="my-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Likes: {{$pivot->points}}</h5>
                        
                    </div>

                    @endforeach
                   
                    <a href="/playlists" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Back</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/audio.js"></script>
</x-app-layout>