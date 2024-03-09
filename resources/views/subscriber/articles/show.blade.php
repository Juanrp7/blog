@extends('layouts.base')

@section('styles')
<link rel="stylesheet" href=" {{ asset('css/manage_post/post/css/article_show.css') }}">
<link rel="stylesheet" href=" {{ asset('css/manage_post/comments/css/comments.css') }}">
@endsection

@section('title', 'Artículo')

@section('content')

    <div class="content-post">

        <div class="post-title line">
            <h2 class="fw-bold"></h2>
        </div>

        <div class="post-introduction line">
            <p></p>
        </div>

        <div class="post-author line">
            <img src="" class="img-author">

            <span>Autor:
                <a href="#"></a>
            </span>
        </div>

        <hr>

        <div class="post-image">
            <img src="" alt="imagen" class="post-image-img">
        </div>

        <div class="post-body line"></div>
        <hr>
    </div>

    <div class="text-primary">
        <h2>Comentarios</h2>
    </div>

    <p class="alert-post">Para comentar debe iniciar sesión</p>

    <div class="text-danger text-center">
        <p class="fs-5"></p>
    </div>
@endsection
