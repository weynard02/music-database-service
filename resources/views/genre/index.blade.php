<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Genres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid-cols-2 sm:grid md:grid-cols-6 ">
                @foreach ($genres as $i)
                <a href="/genres/{{$i->id}}" class="my-5 block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mx-4">
                    <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white capitalize">{{$i->name}} </h3>
                </a>
                @endforeach
                
            </div>
        </div>
    </div>
</x-app-layout>
