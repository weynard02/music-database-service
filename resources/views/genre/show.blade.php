<x-app-layout>
    <x-slot name="header">
        <h2 class="capitalize font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $genre->name }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">{{ session('success') }}</div>
            @endif
            <div class="grid-cols-2 sm:grid md:grid-cols-4 ">
                @foreach($genre->songs as $i)  
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
                            @php
                                $pivot =  $songUser->where('user_id', Auth::user()->id)->where('song_id',$i->id)->first();
                            @endphp
                            <button type="button" id="like-{{$i->id}}" class="ajax-button mb-2 transition transform hover:-translate-y-0 hover:-translate-x-0 hover:scale-150 active:scale-125 text-red-400 dark:text-white" data-id={{$i->id}} value="{{ $pivot && $pivot->is_favourite == true ? 1 : 0}}">
                                {{-- Checking if the pivot data exist or not or if it exists, is it favorite or not --}}
                                
                                @if( $pivot && $pivot->is_favourite == true)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53L12 21.35Z"/></svg>
                                @else
                                    <i data-feather="heart"></i>
                                @endif
                            </button>
                        </div>
                        
                        
                        <h6 class="mt-4 mb-4 text-base text-neutral-600 dark:text-neutral-200">{{ $i->streams }} streams</h6>
                        <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">{{ $i->tags }}</p>
                    </div>
                </div>   
                @endforeach
            </div>
            <div class="ml-2 mt-5">
                <a href="/genres" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Back</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ajax-button').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/songs/fav', // Replace with your route URL
                    method: 'POST', // or 'GET', depending on your route
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle the success response here
                        // console.log('AJAX SUCCESS');
                        const likeButton = document.getElementById('like-'+id);
                        const likeButtonValue = likeButton.value;
                        if (likeButtonValue == 1)
                        {
                            // console.log("Disliked.");
                            likeButton.value = 0;
                            likeButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>';
                        }
                        else {
                            // console.log("Liked!");
                            likeButton.value = 1;
                            likeButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53L12 21.35Z"></path></svg>`;
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script src="../js/audio.js"></script>
</x-app-layout>