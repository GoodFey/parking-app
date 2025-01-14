@extends('layouts.app')

@section('title', 'Все машины')

@section('content')

{{--    <form action="" method="Post">--}}
{{--        @csrf--}}
{{--        <div id="app" class="w-25 p-5">--}}
{{--            <phone-input-mask--}}
{{--                value="{{ old('phone_number', '') }}"--}}
{{--            ></phone-input-mask>--}}
{{--        </div>--}}
{{--        <input type="submit" class="btn btn-info">--}}
{{--    </form>--}}


    <div class="container">
        <table class="table table-secondary table-hover">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">ФИО</th>
                <th scope="col">Автомобиль</th>
                <th scope="col">Номер Автомобиля</th>
                <th scope="col"></th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($carsClientsImages as $carClientImage)

                <tr>
                    <td>
                        <img src="{{$carClientImage->preview_url}}" alt="">
                    </td>
                    <td>{{$carClientImage->fio}}</td>
                    <td>{{$carClientImage->brand}}</td>
                    <td>{{$carClientImage->gos_number}}</td>
                    <td>
                        <form action="{{ route('clients.edit', $carClientImage->client_id) }}">
                            <input type="submit" class="btn btn-primary mb-3" value="Редактировать">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('cars.delete', $carClientImage->car_id) }}" method="Post">
                            @csrf
                            @method('Delete')
                            <input type="submit" class="btn btn-danger mb-3" value="Удалить">
                        </form>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $carsClientsImages->links() }}

    </div>
@endsection
