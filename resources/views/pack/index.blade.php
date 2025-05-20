<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Packs') }}
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
                    <a href="{{ route('pack.create') }}"><x-primary-button>Nuevo Pack</x-primary-button></a>

                    <table class="min-w-full text-center mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Contenidos</th>
                                <th class="px-4 py-2">Precio</th>
                                <th class="px-4 py-2">Sesión</th>
                                <th class="px-4 py-2">Imagen</th>
                                <th class="px-4 py-2">Descripcion</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            @if ($packs->isEmpty())
                                <tr>
                                    <td colspan="7" class="py-4 text-center text-gray-500">
                                        Todavía no has creado ningún pack
                                    </td>
                                </tr>
                            @endif
                            @foreach ($packs as $p)
                                <tr class="border-b hover:bg-indigo-100">
                                    <td class="px-4 py-2">{{ $p->name }}</td>
                                    <td class="px-4 py-2"><a href=""> Enlace a contenidos</a></td>
                                    <td class="px-4 py-2">{{ number_format($p->price, 2) }}€</td>
                                    <td class="px-4 py-2">{{ $p->photoshoot->name }}</td>
                                    <td class="px-4 py-2 flex justify-center items-center"><img
                                            src="{{ asset($p->img_url) }}" width="100px" alt=""></td>
                                    <td class="px-4 py-2">{{ $p->description }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('pack.edit', $p) }}"><x-primary-button><i
                                                    class="fa-solid fa-pen-to-square me-2"></i> {{ __('Editar') }}
                                            </x-primary-button></a>

                                        <form action="{{ route('pack.destroy', $p) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <x-danger-button class="ms-3"
                                                onclick="return confirm('¿Estás seguro de eliminar este tratamiento?')">
                                                <i class="fa-solid fa-trash me-2"></i> {{ __(' Eliminar') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $packs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
