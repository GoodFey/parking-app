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
        <div class="col-6">
            <h1>Edit client page</h1>
        </div>
        <form action="{{ route('clients.index') }}" class="col">
            <button type="submit" class="btn btn-primary mt-3">Назад</button>
        </form>
    </div>
    <div class="row">
        <div class="col-6 border rounded-3">
            <h3>Edit information about client</h3>
            <form action="{{ route('clients.update', $client->id) }}" method="Post" id="formClient">
                @csrf
                @method('Patch')
                <div class="mb-3">
                    <label for="fioInput" class="form-label">ФИО</label>
                    <input type="text" class="form-control" id="fioInput" name="fio"
                           placeholder="Обязательное поле" value="{{ old('fio') ?? $client->fio}}">
                    <div class="text-danger mt-1">
                        @error('fio')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phoneNumInput" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control" id="phoneNumInput" name="phone_number"
                           placeholder="Обязательное поле" value="{{ old('phone_number') ?? $client->phone_number}}">
                    <div class="text-danger mt-1">
                        @error('phone_number')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="addressInput" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="addressInput" name="address"
                           value="{{ old("address") ?? $client->address}}">
                    <div class="text-danger mt-1">
                        @error("address")
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="fioInput" class="form-label">Пол</label>
                    <select id="inputState" class="form-select" name="gender">
                        <option
                            {{ $client->gender ? 'selected' : ''}}
                        >Мужчина
                        </option>
                        <option
                            {{ $client->gender ? '' : 'selected'}}
                        >Женщина
                        </option>
                    </select>
                    <div class="text-danger mt-1">
                        @error("gender")
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="col align-self-end">
            <button type="submit" class="btn btn-primary mb-3" form="formClient">Сохранить</button>
        </div>
    </div>

    @for($i=0; $i < count($cars); $i++)
        <div class="row mt-3">
            <div class="col-6 border rounded-3">
                <h3>Edit information about {{$i+1}} auto</h3>
                <form action="{{ route('cars.update', $cars[$i]->id) }}" method="Post" id="formAuto{{$i}}">
                    @csrf
                    @method('Patch')
                    <div class="mb-3">
                        <label for="brandCarInput" class="form-label">Бренд автомобиля</label>
                        <input type="text" class="form-control" id="brandCarInput" name="brand"
                               placeholder="Обязательное поле" value="{{ old('brand') ?? $cars[$i]->brand }}">
                        <div class="text-danger mt-1">
                            @error('brand')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="modelCarInput" class="form-label">Модель автомобиля</label>
                        <input type="text" class="form-control" id="modelCarInput" name="model"
                               placeholder="Обязательное поле" value="{{ old('model') ?? $cars[$i]->model }}">
                        <div class="text-danger mt-1">
                            @error('model')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="colorCarInput" class="form-label">Цвет автомобиля</label>
                        <input type="text" class="form-control" id="colorCarInput" name="color_of_carcass"
                               placeholder="Обязательное поле"
                               value="{{ old('color_of_carcass') ?? $cars[$i]->color_of_carcass }}">
                        <div class="text-danger mt-1">
                            @error('color_of_carcass')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gosNumberInput" class="form-label">Государственный номер</label>
                        <input type="number" class="form-control" id="gosNumberInput" name="gos_number"
                               placeholder="Обязательное поле" value="{{ old('gos_number') ?? $cars[$i]->gos_number }}">
                        <div class="text-danger mt-1">
                            @error('gos_number')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="car_is_on_parking"
                                   name="is_on_parking_now" {{ $cars[$i]->is_on_parking_now ? 'checked' : '' }}>
                            <label class="form-check-label" for="car_is_on_parking">Машина на парковке</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col align-self-end">
                <button type="submit" class="btn btn-primary mb-3" form="formAuto{{$i}}">Сохранить</button>
            </div>
        </div>
    @endfor
    <div class="row mt-3">
        <div class="col-6 border rounded-3">
            <h3>Add new Auto</h3>
            <form action="{{ route('cars.store', $client->id) }}" id="create_new_auto" method="Post">
                @csrf
                <div class="mb-3">
                    <label for="brandInput" class="form-label">Бренд автомобиля</label>
                    <input type="text" class="form-control" id="brandInput" name="brand_create"
                           placeholder="Обязательное поле" value="{{ old('brand_create') }}">
                    <div class="text-danger mt-1">
                        @error('brand_create')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="modelInput" class="form-label">Модель автомобиля</label>
                    <input type="text" class="form-control" id="modelInput" name="model_create"
                           placeholder="Обязательное поле" value="{{ old('model_create') }}">
                    <div class="text-danger mt-1">
                        @error('model_create')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="colorInput" class="form-label">Цвет автомобиля</label>
                    <input type="text" class="form-control" id="colorInput" name="color_of_carcass_create"
                           placeholder="Обязательное поле" value="{{ old('color_of_carcass_create') }}">
                    <div class="text-danger mt-1">
                        @error('color_of_carcass_create')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="gosNumberInput" class="form-label">Государственный номер</label>
                    <input type="number" class="form-control" id="gosNumberInput" name="gos_number_create"
                           placeholder="Обязательное поле" value="{{ old('gos_number_create') }}">
                    <div class="text-danger mt-1">
                        @error('gos_number_create')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="isOnParkingInput" name="is_on_parking_now"
                               checked>
                        <label class="form-check-label" for="isOnParkingInput">Машина на парковке</label>
                    </div>
                </div>

            </form>
        </div>
        <div class="col align-self-end">
            <button type="submit" class="btn btn-primary mb-3" form="create_new_auto">Добавить</button>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
