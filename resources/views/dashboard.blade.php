<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<!-- Mostrar mensajes flash de éxito o advertencia -->
@if(session('success') || session('warning'))
    <div class="mt-4 flex justify-center">
        <div class="w-full max-w-md"> <!-- Ajustamos el ancho máximo del alert -->
            @if(session('success'))
                <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-3 py-2 rounded-lg" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('warning'))
                <div class="flex items-center bg-yellow-500 text-white text-sm font-bold px-3 py-2 rounded-lg" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                    </svg>
                    <p>{{ session('warning') }}</p>
                </div>
            @endif
        </div>
    </div>
@endif


    <div class="py-12 bg-gray-900">
        <div class="grid grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8 gap-6">

            <!-- Sección para mostrar los enlaces contribuidos -->
            <div class="bg-gray-800 text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-lg font-bold">Community Contributions</h1>

                    <!-- Mostrar mensaje si no hay enlaces aprobados -->
                    <ul class="mt-4">
                        @if ($links->isEmpty())
                            <p>No approved contributions yet.</p>
                        @else
                            @foreach ($links as $link)
                                <li class="mb-4 border-b border-gray-700 pb-2">
                                    <a href="{{ $link->link }}" class="text-blue-400 hover:underline">{{ $link->title }}</a>
                                    <br>
                                    <small class="text-gray-400">
                                        Contributed by: {{ $link->creator->name }} - {{ $link->updated_at->diffForHumans() }}
                                    </small>
                                    <br>
                                    <!-- Mostrar el canal asociado -->
                                    @if ($link->channel)
                                        <span class="inline-block px-2 py-1 text-white text-sm font-semibold rounded"
                                              style="background-color: {{ $link->channel->color }}">
                                            {{ $link->channel->title }}
                                        </span>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>

                    <div class="mt-6">
                        {{ $links->links() }}
                    </div>
                </div>
            </div>

            <!-- Sección para contribuir un nuevo enlace -->
            <div class="bg-gray-800 text-gray-100 p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-bold mb-4">Contribute a link</h2>

                <!-- Mostrar mensaje de éxito si existe -->
                @if (session('message'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Mostrar errores generales al principio del formulario -->
                @if($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Aquí empieza el formulario -->
                <form action="{{ route('community-links.store') }}" method="POST">
                    @csrf

                    <!-- Campo para el título -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-400 mb-2">Title:</label>
                        <input type="text" name="title" id="title"
                        class="w-full bg-gray-700 border border-gray-600 text-gray-200 rounded-lg p-2"
                        value="{{ old('title') }}">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para el enlace -->
                    <div class="mb-4">
                        <label for="link" class="block text-gray-400 mb-2">Link:</label>
                        <input type="url" name="link" id="link"
                        class="w-full bg-gray-700 border border-gray-600 text-gray-200 rounded-lg p-2"
                        value="{{ old('link') }}">
                        @error('link')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para seleccionar canal -->
                    <div class="mb-4">
                        <label for="channel_id" class="block text-gray-400 mb-2">Channel:</label>
                        <select name="channel_id" id="channel_id"
                                class="w-full bg-gray-700 border border-gray-600 text-gray-200 rounded-lg p-2">
                            <option selected disabled>Pick a Channel...</option>
                            @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                    {{ $channel->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('channel_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botón para enviar el formulario -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Contribute!
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
