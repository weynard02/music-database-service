<x-guest-layout>
    <form method="POST" action="/payment">
        @csrf

        <!-- Name -->
        <div class="flex flex-col justify-center align-middle">
            <input type="text" value="{{$user->id}}" name="id" hidden>
            <x-input-label for="name" :value="__('Please pay Rp50000.00')" class="text-center text-xl"/>
            <img src="/images/qris.png" alt="guthib.com" class="h-auto max-w-full rounded-lg">
        </div>

        

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Done') }}
            </x-primary-button>
        </div>

    </form>
    
</x-guest-layout>
<div class="p-4 bg-gray-100 dark:bg-lighter dark:bg-gray-900">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 ">
                        Features
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Free
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Premium
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Playlists
                    </th>
                    <td class="px-6 py-4">
                        Limited to 3
                    </td>
                    <td class="px-6 py-4 ">
                        Unlimited
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Favourite Playlist
                    </th>
                    <td class="px-6 py-4">
                        No
                    </td>
                    <td class="px-6 py-4 ">
                        Yes
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Add Song
                    </th>
                    <td class="px-6 py-4">
                        No
                    </td>
                    <td class="px-6 py-4 ">
                        Yes
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Searching and play Song
                    </th>
                    <td class="px-6 py-4">
                        Yes
                    </td>
                    <td class="px-6 py-4 ">
                        Yes
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>