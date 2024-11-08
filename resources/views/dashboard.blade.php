<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-800 via-gray-900 to-gray-950 min-h-screen">
        <div class="grid grid-cols-1 lg:grid-cols-2 max-w-7xl mx-auto px-6 gap-8 lg:gap-10">

            <!-- Sección para mostrar los enlaces contribuidos -->
            <div class="bg-gray-800 text-gray-200 shadow-lg rounded-lg overflow-hidden">
                <div class="p-8">
                    <h1 class="text-2xl font-semibold mb-4">Community Contributions</h1>

                    <ul class="flex space-x-4">
                        <li>
                            <a class="px-4 py-2 rounded-lg {{ request()->exists('popular') ? 'text-blue-500 hover:text-blue-700' : 'text-gray-500 cursor-not-allowed' }}"
                                href="{{ request()->url() }}">
                                Mas Reciente
                            </a>
                        </li>
                        <li>
                            <a class="px-4 py-2 rounded-lg {{ request()->exists('popular') ? 'text-gray-500 cursor-not-allowed' : 'text-blue-500 hover:text-blue-700' }}"
                                href="?popular">
                                Mas Popular
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Mostrar mensaje si no hay enlaces aprobados -->
                    <ul class="mt-4 space-y-4">
                        @if ($links->isEmpty())
                        <p class="text-gray-400">No approved contributions yet.</p>
                        @else
                        @foreach ($links as $link)
                        <li class="border-b border-gray-700 pb-4 mb-4 last:mb-0">
                            <a href="{{ $link->link }}" class="text-blue-400 text-lg font-medium hover:underline">{{ $link->title }}</a>
                            <p class="text-gray-400 text-sm mt-1">
                                Contributed by: <span class="font-semibold">{{ $link->creator->name }}</span>
                                - {{ $link->updated_at->diffForHumans() }}
                            </p>
                            <!-- Mostrar el canal asociado -->
                            @if ($link->channel)
                            <span class="inline-block mt-2 px-3 py-1 rounded-full text-white text-sm font-semibold"
                                style="background-color: {{ $link->channel->color }}">
                                {{ $link->channel->title }}
                            </span>
                            @endif
                            <!--Parte donde se vota cada link por usuario-->
                            <form method="POST" action="/votes/{{ $link->id }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 rounded 
                                                {{ Auth::check() && Auth::user()->votedFor($link) ? 'bg-green-500 hover:bg-green-600 text-white' : 'bg-gray-500 hover:bg-gray-600 text-white' }}"
                                    {{ !Auth::check() || !Auth::user()->isTrusted() ? 'disabled' : '' }}>
                                    {{ $link->users()->count() }}
                                </button>
                            </form>
                        </li>
                        @endforeach
                        @endif
                    </ul>

                    <div class="mt-6 flex justify-center">
                        {{ $links->appends($_GET)->links() }}
                    </div>
                </div>
            </div>

            <!-- Sección para contribuir un nuevo enlace -->
            <div class="bg-gray-800 text-gray-100 p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-6">Contribute a link</h2>

                <!-- Mostrar mensaje de éxito si existe -->
                @if (session('message'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                    {{ session('message') }}
                </div>
                @endif

                <!-- Mostrar errores generales al principio del formulario -->
                @if($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Formulario para contribuir -->
                <form action="{{ route('community-links.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Campo para el título -->
                    <div>
                        <label for="title" class="block text-gray-300 mb-2">Title:</label>
                        <input type="text" name="title" id="title"
                            class="w-full bg-gray-700 border border-gray-600 text-gray-200 rounded-lg p-3 focus:outline-none focus:border-blue-500"
                            value="{{ old('title') }}">
                        @error('title')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para el enlace -->
                    <div>
                        <label for="link" class="block text-gray-300 mb-2">Link:</label>
                        <input type="url" name="link" id="link"
                            class="w-full bg-gray-700 border border-gray-600 text-gray-200 rounded-lg p-3 focus:outline-none focus:border-blue-500"
                            value="{{ old('link') }}">
                        @error('link')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para seleccionar canal -->
                    <div>
                        <label for="channel_id" class="block text-gray-300 mb-2">Channel:</label>
                        <select name="channel_id" id="channel_id"
                            class="w-full bg-gray-700 border border-gray-600 text-gray-200 rounded-lg p-3 focus:outline-none focus:border-blue-500">
                            <option selected disabled>Pick a Channel...</option>
                            @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                {{ $channel->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('channel_id')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botón para enviar el formulario -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg focus:outline-none shadow-md">
                            Contribute!
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>