<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('photoshoot.store') }}" enctype="multipart/form-data">
    @csrf

    <!--  Name -->
    <div>
        <x-input-label for="name" :value="__('Nombre de la Sesión')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    

    <!-- Imagen -->
  <div x-data="{ preview: null }" class="mt-4">
    <x-input-label for="img_url" :value="__('Imagen')" />

    <input id="img_url" type="file" name="img_url" class="hidden" accept="image/*"
           @change="preview = URL.createObjectURL($event.target.files[0])" required>

    <x-input-label for="img_url"
    class="inline-flex items-center px-4 py-2 bg-indigo-300 border border-transparent rounded-md font-semibold text-xs text-indigo-900 uppercase tracking-widest hover:bg-indigo-900 hover:text-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
    Seleccionar imagen
</x-input-label>


    <!-- Vista previa -->
    <template x-if="preview">
        <img :src="preview" class="mt-2 w-32 h-32 object-cover rounded border border-gray-300 dark:border-gray-600">
    </template>

    <x-input-error :messages="$errors->get('img_url')" />
</div>

    
   <!-- Description -->
<div class="mt-4">
    <x-input-label for="description" :value="__('Description')" />
    <textarea id="description" name="description" rows="4"
        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        {{ old('description') }}
    </textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>


    <!--  Duracion -->
    <div>
        <x-input-label for="duration" :value="__('Duración (Horas)')" />
        <x-text-input id="duration" class="block mt-1 w-full" type="time" name="duration" :value="old('duration')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
    </div>



    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('product.index') }}">
            {{ __('Back to Products') }}
        </a>

        

        <x-primary-button class="ms-4">
            {{ __('Crear Sesión') }}
        </x-primary-button>
    </div>
</form>


                </div>
            </div>
        </div>
    </div>
    <x-footer/>
</x-app-layout>
