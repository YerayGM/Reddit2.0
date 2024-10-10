<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Contribute a link') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="bg-gray-800 text-gray-100 p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-bold mb-4">Contribute a link</h2>
                <!-- Aquí empieza el formulario -->
                <form action="{{ route('community-links.store') }}" method="POST">
                    @csrf
                    <!-- Campo para el título -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-400 mb-2">Title:</label>
                        <input type="text" name="title" id="title"
                            class="w-full bg-gray-700 border border-gray-600 text-gray-200 rounded-lg p-2"
                            value="{{ old('title') }}">
                        <!-- Mostrar error específico para el campo título -->
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
                        <!-- Mostrar error específico para el campo enlace -->
                        @error('link')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Campo para seleccionar el canal -->
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
