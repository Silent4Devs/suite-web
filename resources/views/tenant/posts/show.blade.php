@extends('layouts.tenant', ['title' => $post->title])

@section('content')
    {{ $post->body }}
@endsection
