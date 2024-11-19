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
        <div class="col-6">
            <h3>Edit information about client</h3>
            <form action="{{ route('clients.update') }}" method="patch">
                @csrf
                <div class="mb-3">
                    <label for="fioInput" class="form-label">ФИО</label>
                    <input type="text" class="form-control" id="fioInput" name="fio"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="phoneNumInput" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control" id="phoneNumInput" name="phoneNumber"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="addressInput" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="addressInput" name="address">
                </div>
                <div class="mb-3">
                    <label for="fioInput" class="form-label">Пол</label>
                    <select id="inputState" class="form-select" name="gender">
                        <option selected>Выберите пол (обязательное поле)</option>
                        <option>Мужчина</option>
                        <option>Женщина</option>
                    </select>
                </div>

                <h3>Edit information about Auto</h3>

                <div class="mb-3">
                    <label for="brandCarInput" class="form-label">Бренд автомобиля</label>
                    <input type="text" class="form-control" id="brandCarInput" name="brandCar"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="modelCarInput" class="form-label">Модель автомобиля</label>
                    <input type="text" class="form-control" id="modelCarInput" name="modelCar"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="colorCarInput" class="form-label">Цвет автомобиля</label>
                    <input type="text" class="form-control" id="colorCarInput" name="colorCar"
                           placeholder="Обязательное поле">
                </div>
                <div class="mb-3">
                    <label for="gosNumberInput" class="form-label">Государственный номер</label>
                    <input type="number" class="form-control" id="gosNumberInput" name="gosNumber"
                           placeholder="Обязательное поле">
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
