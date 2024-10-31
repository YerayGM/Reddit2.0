<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-100 leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-800 via-gray-900 to-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-gray-800 text-gray-200 shadow-lg rounded-lg overflow-hidden">
                <div class="p-8">
                    <div class="text-lg mb-4">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
