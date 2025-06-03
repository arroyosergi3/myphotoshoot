<x-app-layout>

     

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
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
                    <h1 class="text-indigo-900 text-xl mb-6">Añadir productos al {{ $pack->name }}</h1>

<form action="{{ route('pack.addcontent', $pack) }}" method="POST">
    @csrf

   @foreach($photographerProducts as $product)
    @php
        $inPack = $productsInPack->has($product->id);
        $quantity = $inPack ? $productsInPack[$product->id]->pivot->cuantity : 1;
    @endphp

    <div class=" flex mb-4 items-center">
        <input type="checkbox" name="products[{{ $product->id }}][selected]" 
               id="product_{{ $product->id }}" class="mx-2 w-5 h-5 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300"
               {{ $inPack ? 'checked' : '' }}>

        <x-input-label for="product_{{ $product->id }}">{{ $product->name }}</x-input-label>

        <input type="number" class="mx-2    bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500  focus:border-blue-500 block  p-2.5 "
               name="products[{{ $product->id }}][cuantity]"
               value="{{ $quantity }}"
               min="1"
               {{ $inPack ? '' : 'disabled' }}/>
    </div>
@endforeach


    <x-primary-button >Guardar productos al pack</x-primary-button>
</form>

<script>
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', function () {
            const parent = cb.closest('div');
            const input = parent.querySelector('input[type="number"]');
            input.disabled = !cb.checked;
        });
    });
</script>





                </div>
            </div>
        </div>
    </div>
    
    <x-footer/>
</x-app-layout>
