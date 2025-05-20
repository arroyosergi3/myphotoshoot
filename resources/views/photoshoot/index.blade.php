<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Sesiones') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <x-alert t="success" m="{{ session('success') }}"></x-alert>
            @endif
            @if (session('error'))
                <x-alert t="error" m="{{ session('error') }}"></x-alert>
            @endif
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('photoshoot.create') }}"><x-primary-button>Nueva Sesión</x-primary-button></a>

                    <table class="min-w-full text-center mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Imagen</th>
                                <th class="px-4 py-2">Descripcion</th>
                            </tr>

                        </thead>
                        <tbody>
                            @if ($photoshoots->isEmpty())
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">
                                        Todavía no has creado ninguna sesión
                                    </td>
                                </tr>
                            @endif


                            @foreach ($photoshoots as $ps)
                                <tr class="border-b hover:bg-indigo-100 hover:rounded">
                                    <td class="px-4 py-2">{{ $ps->name }}</td>
                                    <td class="px-4 py-2">{{ $ps->description }}</td>
                                    <td class="px-4 py-2 flex justify-center items-center"><img
                                            src="{{ asset($ps->img_url) }}" width="100px" alt=""></td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('photoshoot.edit', $ps) }}"><x-primary-button><i
                                                    class="fa-solid fa-pen-to-square me-2"></i> {{ __('Editar') }}
                                            </x-primary-button></a>

                                        <form action="{{ route('photoshoot.destroy', $ps) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            {{-- Botón que abre el modal --}}
                                            <x-danger-button class="ms-3" x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion-{{ $ps->id }}')">
                                                <i class="fa-solid fa-trash me-2"></i> {{ __(' Eliminar') }}
                                            </x-danger-button>

                                            {{-- Modal de confirmación --}}
                                            <x-modal name="confirm-product-deletion-{{ $ps->id }}"
                                                :show="$errors->productDeletion->isNotEmpty()" focusable>
                                                <div class="p-6">
                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        ¿Estás seguro de que quieres eliminar este tratamiento?
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        Una vez que el tratamiento sea eliminado, todos sus datos se
                                                        borrarán permanentemente.
                                                    </p>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancelar') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Eliminar Producto') }}
                                                        </x-danger-button>
                                                    </div>
                                                </div>
                                            </x-modal>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $photoshoots->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
