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

    <example-component
    :is-async="true"></example-component>

</div>
</body>
</html>
@endsection
