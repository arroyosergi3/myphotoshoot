<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Sesiones Disponibles') }}
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
                <div class="p-6 text-gray-900 ">
                    
                    @if($photoshoots->isEmpty())
                        <p>El fotógrafo todavía no tiene sesiones</p>
                    @else
                                <div class="flex justify-center items-center">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl">
        
                    @foreach ($photoshoots as $ps)
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm ">
                            <a href="{{ route('photoshootPacks', ['photographer' => $photographer->id, 'photoshoot' => $ps->id])  }}">
                                <img class="rounded-t-lg" src="{{ asset($ps->img_url) }}" alt="{{ $ps->name }}" />
                            </a>
                            <div class="p-5">
                                <a href="{{ route('photoshootPacks', ['photographer' => $photographer->id, 'photoshoot' => $ps->id])  }}">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-indigo-900 ">
                                       {{ $ps->name }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-indigo-900">
                                    {{ $ps->description }}
                                </p>
                                <x-primary-button onclick="window.location.href='{{ route('photoshootPacks', ['photographer' => $photographer->id, 'photoshoot' => $ps->id]) }}'"> Ver packs</x-primary-button>
                            </div>
                        </div>
                    @endforeach
                                </div>
                                </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
