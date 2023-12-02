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
