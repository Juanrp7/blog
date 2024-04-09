@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Bienvenidos al panel de adminstracion</h1>
@stop

@section('content')
    <p>Hola {{ Auth::user()->full_name }} desde aqui podras administrar tus articulos, categorias y comentarios</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/public/vendor/adminlte/dist/css/adminlte.css"> 
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop