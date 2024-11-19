<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <h1>Edit client page</h1>
        <div class="col-6 border rounded-3">
            <h3>Edit information about client</h3>
            <form action="{{ route('clients.index') }}" id="formClient">
                @csrf
                <div class="mb-3">
                    <label for="fioInput" class="form-label">ФИО</label>
                    <input type="text" class="form-control" id="fioInput" name="fio"
                           placeholder="Обязательное поле" value="{{ old('fio') ?? $client->fio}}">
                </div>
                <div class="mb-3">
                    <label for="phoneNumInput" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control" id="phoneNumInput" name="phoneNumber"
                           placeholder="Обязательное поле" value="{{ old('phone_number') ?? $client->phone_number}}">
                </div>
                <div class="mb-3">
                    <label for="addressInput" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="addressInput" name="address"
                           value="{{ old('fio') ?? $client->address}}">
                </div>
                <div class="mb-3">
                    <label for="fioInput" class="form-label">Пол</label>
                    <select id="inputState" class="form-select" name="gender">
                        <option selected>Выберите пол (обязательное поле)</option>
                        <option>Мужчина</option>
                        <option>Женщина</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col align-self-end">
            <button class="btn btn-primary mb-3" form="formClient">Сохранить</button>
        </div>
    </div>

    @for($i=0; $i < count($cars); $i++)
        <div class="row mt-3">
            <div class="col-6 border rounded-3">
                <h3>Edit information about {{$i+1}} auto</h3>
                <form action="{{ route('clients.index') }}" id="formAuto{{$i}}">
                    @csrf
                    <div class="mb-3">
                        <label for="brandCarInput" class="form-label">Бренд автомобиля</label>
                        <input type="text" class="form-control" id="brandCarInput" name="brand"
                               placeholder="Обязательное поле" value="{{ old('brand') ?? $cars[$i]->brand }}">
                    </div>
                    <div class="mb-3">
                        <label for="modelCarInput" class="form-label">Модель автомобиля</label>
                        <input type="text" class="form-control" id="modelCarInput" name="model"
                               placeholder="Обязательное поле" value="{{ old('model') ?? $cars[$i]->model }}">
                    </div>
                    <div class="mb-3">
                        <label for="colorCarInput" class="form-label">Цвет автомобиля</label>
                        <input type="text" class="form-control" id="colorCarInput" name="color_of_carcass"
                               placeholder="Обязательное поле"
                               value="{{ old('color_of_carcass') ?? $cars[$i]->color_of_carcass }}">
                    </div>
                    <div class="mb-3">
                        <label for="gosNumberInput" class="form-label">Государственный номер</label>
                        <input type="number" class="form-control" id="gosNumberInput" name="gos_number"
                               placeholder="Обязательное поле" value="{{ old('gos_number') ?? $cars[$i]->gos_number }}">
                    </div>
                    <div class="mb-3">
                        @if($cars[$i]->is_on_parking_now == 1)

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="car_is_on_parking" checked>
                                <label class="form-check-label" for="car_is_on_parking">Машина на парковке (Да /
                                    Нет)</label>
                            </div>
                        @else
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="car_is_on_parking">
                                <label class="form-check-label" for="car_is_on_parking">Машина на парковке</label>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col align-self-end">
                <button class="btn btn-primary mb-3" form="formAuto{{$i}}">Сохранить</button>
            </div>
        </div>
    @endfor
    <div class="row mt-3">
        <div class="col-6 border rounded-3">
            <h3>Add new Auto</h3>
            <form action="{{ route('clients.index') }}" id="create_new_auto_form">
                @csrf
                <div class="mb-3">
                    <label for="brandCarInput" class="form-label">Бренд автомобиля</label>
                    <input type="text" class="form-control" id="brandCarInput" name="brand"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="modelCarInput" class="form-label">Модель автомобиля</label>
                    <input type="text" class="form-control" id="modelCarInput" name="model"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="colorCarInput" class="form-label">Цвет автомобиля</label>
                    <input type="text" class="form-control" id="colorCarInput" name="color_of_carcass"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="gosNumberInput" class="form-label">Государственный номер</label>
                    <input type="number" class="form-control" id="gosNumberInput" name="gos_number"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="car_is_on_parking" checked>
                        <label class="form-check-label" for="car_is_on_parking">Машина на парковке (Да /
                            Нет)</label>
                    </div>
                </div>

            </form>
        </div>
        <div class="col align-self-end">
            <button class="btn btn-primary mb-3" form="create_new_auto_form">Добавить</button>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
