<x-mail::message>
<h1> Tienes un nuevo documento asignado.</h1>

<p>Datos Generales</p>

<x-mail::panel>
<p><strong>Folio</strong> : {{ $documento->folio }}</p>
<p><strong>Asunto</strong> : {{$documento->asunto}}</p>
</x-mail::panel>

</x-mail::message>