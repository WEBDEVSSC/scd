<x-mail::message>

<h1>Datos Generales</h1>

<x-mail::panel>
<p><strong>Folio</strong> : {{ $documento->siglas }}/{{ $documento->tipo }}/{{ $documento->consecutivo }}/{{ $documento->created_at->format('Y') }}</p>
<p><strong>Asunto</strong> : {{$documento->asunto}}</p>
<p><strong>Área</strong> : {{$documento->area_label}}</p>
<p><strong>Status</strong> : {{$documento->status_label}}</p>
</x-mail::panel>

</x-mail::message>