@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Establecer roles</h1>
@endsection

@section('content')

@if (session('success-update'))
<div class="alert alert-info">
    {{session('success-update')}}
</div>
@endif

<div class="card">
    <div class="card-body">
        <p>Nombre completo:</p>
        <p class="form-control">{{$user->full_name}}</p>

        <h5>Roles</h5>
        <form action="{{route('users.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')

            @foreach ($roles as $rol)
            <div>
                <label>
                    <input type="radio" 
                            name="role" 
                            id="role" 
                            value="{{$rol->id}}" 
                            {{$user->roles->contains($rol->id) ? 'checked' : ''}}
                            class="mr-1 mb-3">
                            {{$rol->name}}
                </label>
            </div>
            @endforeach
            <input type="submit" value="Establecer rol" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection

