<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Genres') }} for {{ $song->artist->name }} - {{ $song->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="/genres/add/{{$song->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="genres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genres:</label>
                    @foreach($genres as $genre)
                        <div class="flex items-center mb-4">
                            <input {{ $genre->songs->contains($song) ? 'checked' : '' }} id="default-checkbox" type="checkbox" name="genres[]" value="{{$genre->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="capitalize ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$genre->name}}</label>
                        </div>
                    @endforeach
                </select>
                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 my-3">Submit</button>
                
            </form>
        </div>
    </div>
</x-app-layout>
