<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $bank?->name)" autocomplete="name" placeholder="Name"/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
    <div>
        <x-input-label for="address" :value="__('Address')"/>
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $bank?->address)" autocomplete="address" placeholder="Address"/>
        <x-input-error class="mt-2" :messages="$errors->get('address')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>