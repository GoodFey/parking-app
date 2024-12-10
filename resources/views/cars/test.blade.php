@extends('layouts.app')

@section('title', 'Все машины')

@section('content')

    <!DOCTYPE html>
<html lang="en">
<head>
    <title>PrimeVue + CDN</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width"/>
</head>
<body>

<div id="app">
    <auto-compete
    :is-async="true"
    ></auto-compete>
</div>

</body>
</html>
@endsection
