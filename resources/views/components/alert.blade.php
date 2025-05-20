@props(['t', 'm']) 
@if($t == "success")
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
    <span class="font-medium me-2">Éxito</span> {{ $m }}
</div>
@endif
@if($t == "error")
<div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
    <span class="font-medium me-2">Error</span> {{ $m }}
</div>

@endif