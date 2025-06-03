<x-app-layout>



    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Pide Cita') }}
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

                    <form method="POST" action="{{ route('appointment.store') }}">
                        @csrf
                       
                        <!-- Date -->
                        <div>
                            <x-input-label for="date" :value="__('Día')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                :value="old('date')" required autofocus />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>



                        <!-- Time -->
                        <div class="mt-4">
    <x-input-label for="time" :value="__('Hora disponible')" />
    <select id="time" name="time" class="block mt-1 w-full" required>
        <option value="">Selecciona un día primero</option>
    </select>
    <x-input-error :messages="$errors->get('time')" class="mt-2" />
</div>





<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');
    const photographerIdInput = document.getElementById('photographer_id');

    dateInput.addEventListener('change', function () {
        const selectedDate = this.value;
        if (!selectedDate) return;

        const photographerId = photographerIdInput.value;
        console.log("ID DEL FOTOGRAFO: " + photographerId);

        fetch(`/available-hours?date=${selectedDate}&photographer_id=${photographerId}`)
            .then(response => response.json())
            .then(data => {
                timeSelect.innerHTML = ''; 

                if (data.length === 0) {
                    timeSelect.innerHTML = '<option value="">No hay horas disponibles</option>';
                    return;
                }

                data.forEach(hour => {
                    const option = document.createElement('option');
                    option.value = hour;
                    option.textContent = hour;
                    timeSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al obtener las horas:', error);
                timeSelect.innerHTML = '<option value="">Error al cargar</option>';
            });
    });
});
</script>


                    </form>

                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
