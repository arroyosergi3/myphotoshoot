<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Crear Pack') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <form method="POST" action="{{ route('pack.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Descripcion -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Descripcion')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                :value="old('description')" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Sesión -->
                        <div class="mt-4">
                            <x-input-label for="photoshoot" :value="__('Sesión')" />
                            <select id="photoshoot" name="photoshoot"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                @if (!empty($photoshoots))
                                    <option value="">Selecciona una sesión</option>
                                    @foreach ($photoshoots as $ps)
                                        <option value="{{ $ps->id }}">{{ $ps->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">No hay sesiones disponibles</option>
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>



                        <!-- Precio -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Precio')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                                :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
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
                                <img :src="preview"
                                    class="mt-2 w-32 h-32 object-cover rounded border border-gray-300 dark:border-gray-600">
                            </template>

                            <x-input-error :messages="$errors->get('img_url')" />
                        </div>




                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Crear Pack') }}
                            </x-primary-button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
