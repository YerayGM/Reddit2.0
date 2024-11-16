<!-- resources/views/profile/partials/update-profile-image-form.blade.php -->
<form method="POST" action="{{ route('profile.update') }}" id="updateImage" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Campo de imagen -->
    <div>
        <label for="image" class="block text-gray-700 dark:text-gray-300">Imagen de perfil:</label>
        <input type="file" name="image" id="image" class="mt-1 block w-full text-gray-900 dark:text-gray-100">
        @error('image')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Botón de actualización -->
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Actualizar Imagen</button>
    </div>
</form>
