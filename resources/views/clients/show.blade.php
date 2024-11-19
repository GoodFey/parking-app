<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parking app</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1>Client Information</h1>
<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">ФИО</th>
        <th scope="col">gender</th>
        <th scope="col">phone_number</th>
        <th scope="col">address</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th scope="row">{{$client->id}}</th>
        <th scope="row">{{$client->fio}}</th>
        <th scope="row">{{$client->gender}}</th>
        <th scope="row">{{$client->phone_number}}</th>
        <th scope="row">{{$client->address}}</th>
    </tr>

    </tbody>
</table>
<a href="{{ route('clients.index') }}">Назад</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
