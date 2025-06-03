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
                    
                    <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                        <!-- Campo oculto con el ID del fotógrafo -->
                    <input type="hidden" name="photographer_id" value="{{ $photographer->id }}">

                    

                    </form>

                </div>
            </div>
        </div>
    </div>
    
    <x-footer/>
</x-app-layout>
