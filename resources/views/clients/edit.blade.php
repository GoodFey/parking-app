@extends('layouts.app')

@section('title', 'Редактирование клиента и его машин')

@section('content')

    <div class="container mt-3" id="app">
        <div class="row">
                <general-edit-component
                    :client="{{ json_encode($client) }}"
                    :cars="{{ json_encode($cars) }}">
                </general-edit-component>
        </div>
@endsection
