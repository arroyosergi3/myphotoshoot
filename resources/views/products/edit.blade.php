<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('product.update', $p) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <x-input-label for="name" :value="__('Nombre')" />
        <textarea id="name"
                  class="block mt-1 w-full rounded  border-gray-300  "
                  name="name">{{ old('name', $p->name) }}</textarea>
        <x-input-error :messages="$errors->get('name')" />
    </div>

    <div class="mb-4">
        <x-input-label for="description" :value="__('Descripción')" />
        <textarea id="description"
                  class="block mt-1 w-full rounded  border-gray-300  "
                  name="description">{{ old('description', $p->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" />
    </div>

    <div class="mb-4">
        <x-input-label for="price" :value="__('Precio')" />
        <x-text-input id="price"
                      class="block mt-1 w-full"
                      type="number"
                      name="price"
                      step="0.01"
                      :value="old('price', $p->price)"
                      required />
        <x-input-error :messages="$errors->get('price')" />
    </div>

    <div x-data="{ preview: null }" class="mb-4">
    <!-- Título del campo -->
    <x-input-label for="pic" :value="__('Imagen')" class="mb-1" />

    <!-- Input file oculto -->
    <input id="pic"
           x-ref="pic"
           type="file"
           name="pic"
           accept="image/*"
           class="hidden"
           @change="preview = URL.createObjectURL($refs.pic.files[0])" />

    <!-- Botón estilizado con x-input-label -->
   
    
    <!-- Imagen -->
  <div x-data="{ preview: null }" class="mt-4">
    <x-input-label for="img_url" :value="__('Imagen')" />

    <input id="img_url" type="file" name="img_url" class="hidden" accept="image/*"
           @change="preview = URL.createObjectURL($event.target.files[0])">

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

    <!-- Imagen actual del servidor -->
    @if ($p->img_url)
        <p class="mt-2 text-sm text-gray-500 ">
            Imagen actual:
        </p>
        <img src="{{ asset($p->img_url) }}"
             alt="Imagen actual"
             class="mt-2 w-20 h-20 object-cover rounded border border-gray-300 ">
    @endif
    
</div>


    <x-primary-button>
        Actualizar
    </x-primary-button>
</form>
            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
