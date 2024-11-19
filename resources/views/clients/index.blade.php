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
<div class="container text-center">
    <div class="row">
        <div class="col">
            <h1>All clients of parking</h1>
        </div>
        <div class="col">

            <a href="{{ route('clients.create') }}">Добавить</a>

        </div>
    </div>
</div>


<div class="container">

    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Автомобиль</th>
            <th scope="col">Номер Автомобиля</th>
            <th scope="col">Посмотреть</th>
            <th scope="col">Изменить</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clientsAndCars as $item)
            <tr>
                <th scope="row">{{$item->fio}}</th>
                <th scope="row">{{$item->brand}}</th>
                <th scope="row">{{$item->gos_number}}</th>
                <th>
                    <a href="{{ route('clients.show', $item->id) }}">Посмотреть</a>
                </th>
                <th>
                    <a href="{{ route('clients.edit', $item->id) }}">Редактировать</a>
                </th>
                </th>
                <th>
                    <a href="{{ route('clients.show', $item->id) }}">Удалить</a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $clientsAndCars->links() }}

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
