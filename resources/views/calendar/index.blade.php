<x-app-layout>
    <x-slot name="header">
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.17/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/web-component@6.1.17/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.17/index.global.min.js'></script>

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
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    
    <x-footer/>

    <!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/appointments',
                selectable: false,
                editable: false
            });
            calendar.render();
        });
    </script>


</x-app-layout>
