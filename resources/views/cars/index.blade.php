@extends('layouts.app')

@section('title', 'Все машины')

@section('content')
{{--<div class="container text-center">--}}
{{--    <div class="row">--}}
{{--        <div class="col-6">--}}
{{--            <h1>Все клиенты и машины</h1>--}}
{{--        </div>--}}
{{--        <form class="col" action="{{ route('cars.onParking', '0') }}">--}}
{{--            <input type="submit" class="btn btn-primary mt-2" value="Ввести машину на парковку">--}}
{{--        </form>--}}
{{--        <form class="col" action="{{ route('clients.create') }}">--}}
{{--            <input type="submit" class="btn btn-info mt-2" value="Создать нового клиента">--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

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
@endsection
