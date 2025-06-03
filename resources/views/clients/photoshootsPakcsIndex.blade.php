<x-app-layout>



    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Packs de la Sesión') }}
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
            <div class=" overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    
                    @if($packs->isEmpty())
                        <p>Esta sesión todavía no tiene packs</p>
                    @else
                                <div class="flex justify-center items-center">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl">
                    @foreach ($packs as $p)
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm  ">
                            <a href="#">
                                <img class="rounded-t-lg" src="{{ asset($p->img_url) }}" alt="{{ $p->name }}" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-indigo-900 ">
                                       {{ $p->name }}</h5>
                                </a>
                                <h5 class="mb-2 text-2xl  tracking-tight text-indigo-900 ">
                                       {{ $p->price }}€</h5>
                                <p class="mb-3 font-normal text-indigo-900 ">
                                    {{ $p->description }}
                                </p>
                                <ul class="list-disc list-inside text-indigo-900 mb-3">
    @foreach($p->products as $pro)
        <li class="mb-2">
            {{ $pro->name }}
            <span class="text-sm text-gray-500"> (Cantidad: {{ $pro->pivot->cuantity }})</span>
        </li>
    @endforeach
</ul>


                                <a href="{{ route('appointment.create', ['pack' => $p->id]) }}">
    <x-primary-button>Reservar Cita</x-primary-button>
</a>
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
