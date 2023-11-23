<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $playlist->name }} 
        </h2>
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
                        
                        <form action="/playlists/{{$playlist->id}}/{{$i->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('delete')
                            <a href="/songs/{{$i->id}}" class="my-6 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Listen</a>
                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            {{-- Checking if the pivot data exist or not or if it exists, is it favorite or not --}}
                            @php
                                $pivot =  $playlistSong->where('song_id',$i->id)->first();
                            @endphp
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Likes: {{$pivot->points}}</h5>
                        </form>
                        
                    </div>

                    @endforeach
                    <form action="/playlists/add/{{$playlist->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="relative z-0 w-full mb-6 group" x-data="{ songs: [] }">
                            <template x-for="(song, index) in songs" :key="index">
                                <div class="mb-4">
                                    <label for="song" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Song *</label>
                                    <select :id="'song' + index" name="songs[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>-</option>
                                        @foreach($songs as $i)
                                            <option value="{{$i->id}}">{{$i->title}} / {{$i->artist->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="mt-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" @click="songs.splice(index, 1)">Remove</button>
                                </div>
                                
                            </template>
                            <button type="button" onclick="activeSubmitPlaylist()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" @click="songs.push('')">Add Song</button>
                        </div>
                        @error('songs.*')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">{{ $message }}</div>
                        @enderror
                        <button type="submit" id="submitAdd" class="invisible">Submit</button>
                    </form>
                    <a href="/playlists" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Back</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/audio.js"></script>
    <script>
        function activeSubmitPlaylist() {
            var btn_submit = document.getElementById('submitAdd');
            btn_submit.className = "mb-8 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800";
        }
    </script>
</x-app-layout>