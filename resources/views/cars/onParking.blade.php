@extends('layouts.app')

@section('title', 'Машины на парковке')

@section('content')
{{--<div class="container text-center">--}}
{{--    <div class="row align-items-center">--}}
{{--        <div class="col-6">--}}
{{--            <h1>Машины на стоянке</h1>--}}
{{--        </div>--}}
{{--        <form class="col" action="{{ route('cars.index') }}">--}}
{{--            <input type="submit" class="btn btn-primary mt-2" value="Назад">--}}
{{--        </form>--}}

{{--    </div>--}}
{{--</div>--}}

<div class="container">
    <div class="row">
        <div class="col">
            <h3>
                Добавить машину на стоянку
            </h3>
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
                    Добавить автомобиль на стоянку
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
@endsection
