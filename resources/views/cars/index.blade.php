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
        <div class="col-6">
            <h1>Все клиенты и машины</h1>
        </div>
        <form class="col" action="{{ route('cars.onParking', '0') }}">
            <input type="submit" class="btn btn-primary mt-2" value="Ввести машину на парковку">
        </form>
        <form class="col" action="{{ route('clients.create') }}">
            <input type="submit" class="btn btn-info mt-2" value="Создать нового клиента">
        </form>
    </div>
</div>

<div class="container">

    <table class="table table-secondary table-hover">
        <thead>
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Автомобиль</th>
            <th scope="col">Номер Автомобиля</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Удалить</th>

        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)

            <tr>
                <td>{{\App\Models\Client::getClient($car->client_id)->fio}}</td>
                <td>{{$car->brand}}</td>
                <td>{{$car->gos_number}}</td>
                <td>
                    <form action="{{ route('clients.edit', $car->client_id) }}">
                        <input type="submit" class="btn btn-primary mb-3" value="Редактировать">
                    </form>
                </td>
                <td>
                    <form action="{{ route('cars.delete', $car->id) }}" method="Post">
                        @csrf
                        @method('Delete')
                        <input type="submit" class="btn btn-danger mb-3" value="Удалить">
                    </form>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $cars->links() }}

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
