<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create new client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Создание нового клиента</h1>
        </div>
        <form action="{{ route('cars.index') }}" class="col">
            <button type="submit" class="btn btn-primary mt-3">Назад</button>
        </form>
    </div>
    <div class="row">
        <div class="col-6 border rounded-3">
            <h3>Добавить информацию о клиенте</h3>
            <form action="{{ route('clients.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="fioInput" class="form-label">ФИО</label>
                    <input type="text" class="form-control" id="fioInput" name="fio"
                           placeholder="Обязательное поле" value="{{ old('fio') }}">
                    @error('fio')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phoneNumInput" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control" id="phoneNumInput" name="phone_number"
                           placeholder="Обязательное поле" value="{{ old('phone_number') }}">
                    @error('phone_number')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="addressInput" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="addressInput" name="address"
                           value="{{ old('address') }}">
                    @error('address')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="fioInput" class="form-label">Пол</label>
                    <select id="inputState" class="form-select" name="gender">
                        <option selected>Выберите пол (обязательное поле)</option>
                        <option>Мужчина</option>
                        <option>Женщина</option>
                    </select>
                    @error('gender')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <h3>Добавить информацию об автомобиле</h3>

                <div class="mb-3">
                    <label for="brandCarInput" class="form-label">Бренд автомобиля</label>
                    <input type="text" class="form-control" id="brandCarInput" name="brand"
                           placeholder="Обязательное поле" value="{{ old('brand') }}">
                    @error('brand')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="modelCarInput" class="form-label">Модель автомобиля</label>
                    <input type="text" class="form-control" id="modelCarInput" name="model"
                           placeholder="Обязательное поле" value="{{ old('model') }}">
                    @error('model')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="colorCarInput" class="form-label">Цвет автомобиля</label>
                    <input type="text" class="form-control" id="colorCarInput" name="color_of_carcass"
                           placeholder="Обязательное поле" value="{{ old('color_of_carcass') }}">
                    @error('color_of_carcass')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gosNumberInput" class="form-label">Государственный номер</label>
                    <input type="number" class="form-control" id="gosNumberInput" name="gos_number"
                           placeholder="Обязательное поле" value="{{ old('gos_number') }}">
                    @error('gos_number')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="isOnParkingInput" name="is_on_parking_now"
                               checked>
                        <label class="form-check-label" for="isOnParkingInput">Машина на парковке</label>
                    </div>
                </div>


                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" Value="Добавить">
                </div>

            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
