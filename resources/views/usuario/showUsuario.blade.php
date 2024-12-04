@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Usuarios :: Dashboard</strong></h1>
@stop

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><strong>Lista de registros</strong></h3>
        </div> 
        <div class="card-body">

            

        <p>Nomnbre : {{$usuario->name}}</p>
        <p>E-mail : {{$usuario->email}}</p>
        <p>Cargo : {{$usuario->cargo}}</p>
        <p>Área : {{$usuario->id_area_label}}</p>
        <p>Nivel : {{$usuario->nivel}}</p>

        <p>Firma: </p>
        <img src="{{ asset($usuario->firma) }}" width="300px" alt="Firma del usuario">

    
        </div>
    </div>

    
    
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop