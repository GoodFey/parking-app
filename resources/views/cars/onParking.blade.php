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
            <h1>Машины на стоянке</h1>
        </div>
        <form class="col" action="{{ route('cars.index') }}">
            <input type="submit" class="btn btn-primary mt-2" value="Назад">
        </form>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>
                Добавить машину на стоянку
            </h1>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputSelectClient">Клиент</label>
                <select class="form-select" id="inputSelectClient" onchange="loadSecondList()">
                    @if($selectedClient != null)
                        <option selected>{{ $selectedClient->fio }}</option>
                    @else
                        <option selected>Выберите клиента</option>
                    @endif
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->fio }}</option>
                    @endforeach
                </select>
            </div>
            <form class="input-group mb-3" id="selectCarForm" action="{{ route('cars.updateParkingStatus', '12') }}" method="Post">
                @csrf
                @method('Patch')
                <label class="input-group-text" for="selectCarSelector">Машина</label>
                <select class="form-select" id="selectCarSelector">
                    @if($selectedClient != null)
                        <option selected>Выберите автомобиль этого клиента</option>
                        @foreach($selectedClientCars as $car)
                            <option value="{{ $car->id }}">
                                {{ $car->brand }}
                                @if($car->is_on_parking_now == 1)
                                    - Машина уже на стоянке
                                @endif
                            </option>

                        @endforeach
                    @else
                        <option selected>Выберите клиента</option>
                    @endif
                </select>
            </form>
            <div>
                <button type="submit" class="btn btn-primary mt-1" form="selectCarForm">
                    Добавить
                </button>
            </div>
        </div>
        <div class="col-6">
            <table class="table table-secondary table-hover">
                <thead>
                <tr>
                    <th scope="col">ФИО</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Номер Автомобиля</th>
                    <th scope="col">Убрать со стоянки</th>


                </tr>
                </thead>
                <tbody>
                @foreach($carsOnParking as $car)

                    <tr>
                        <td>{{\App\Models\Client::getClient($car->client_id)->fio}}</td>
                        <td>{{$car->brand}}</td>
                        <td>{{$car->gos_number}}</td>
                        <td>
                            <form action="{{ route('cars.removeFromParking', $car->id) }}" method="Post">
                                @csrf
                                @method('Patch')
                                <input type="submit" class="btn btn-primary mb-3" value="Убрать">
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>


    </div>

</div>
<script>
    function loadSecondList() {
        const $select = document.getElementById('inputSelectClient')
        const $valueOfSelect = $select.value;

        let $url = "{{ route('cars.onParking', ':clientId') }}";
        $url = $url.replace(':clientId', $valueOfSelect);

        document.location.href = $url;
    }
</script>


<script>
    document.getElementById('selectCarSelector').addEventListener('change', function () {
        const $selectedId = this.value;
        const $form = document.getElementById('selectCarForm');
        let $url = "{{ route('cars.updateParkingStatus', ':carId') }}";
        $url = $url.replace(':carId', $selectedId)
        $form.action = $url;

    })
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
