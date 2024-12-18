<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-100 leading-tight">
            {{ __('My Links') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-800 via-gray-900 to-gray-950 min-h-screen">
        <div class="container mx-auto px-6">

            <!-- Mostrar mensajes flash de éxito o advertencia -->
            @if(session('success') || session('warning'))
                <div class="mt-4 flex justify-center">
                    <div class="w-full max-w-md">
                        @if(session('success'))
                            <div class="flex items-center bg-blue-500 text-white text-sm font-semibold px-4 py-3 rounded-lg shadow-md mb-4" role="alert">
                                <svg class="fill-current w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                </svg>
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                        @if(session('warning'))
                            <div class="flex items-center bg-yellow-500 text-white text-sm font-semibold px-4 py-3 rounded-lg shadow-md" role="alert">
                                <svg class="fill-current w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                </svg>
                                <p>{{ session('warning') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Lista de enlaces -->
            <div class="bg-gray-800 text-gray-200 rounded-lg shadow-lg p-6 mt-6">
                <ul>
                    @foreach ($links as $link)
                        <li class="flex justify-between items-center mb-4 bg-gray-700 p-4 rounded-lg hover:bg-gray-600 transition duration-200 ease-in-out">
                            <div>
                                <a href="{{ $link->link }}" class="text-blue-400 hover:underline text-lg font-semibold">{{ $link->title }}</a>
                                <div class="text-sm text-gray-400 mt-1">
                                    Submitted on {{ $link->created_at->format('d M Y') }} |
                                    @if ($link->status == 'approved')
                                        <span class="text-green-400 font-bold">Approved</span>
                                    @elseif ($link->status == 'pending')
                                        <span class="text-yellow-400 font-bold">Pending</span>
                                    @endif
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $link->category == 'Tailwind' ? 'bg-blue-500 text-white' : 'bg-white text-black' }}">
                                {{ $link->category }}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <!-- Paginación -->
                <div class="mt-6">
                    {{ $links->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
