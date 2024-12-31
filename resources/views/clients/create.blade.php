@extends('layouts.app')

@section('title', 'Создать нового клиента')

@section('content')
    <div class="container">

        <div class="row mt-3">
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
                               value="{{ old('phone_number') }}">
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
                        <select id="inputState" class="form-select" name="gender" required>
                            <option selected>Выберите пол (обязательное поле)</option>
                            <option value="1">Мужчина</option>
                            <option value="0">Женщина</option>
                        </select>
                        @error('gender')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <h3>Добавить информацию об автомобиле</h3>

                    <div class="mb-3" id="app">
                        <label for="brandCarInput" class="form-label">Бренд автомобиля</label>
                        <car-brand-auto-complete></car-brand-auto-complete>
                        <dropzone-component></dropzone-component>
                        @error('brand')
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
                        <input type="text" class="form-control" id="gosNumberInput" name="gos_number"
                               placeholder="A001AA34" value="{{ old('gos_number') }}">
                        @error('gos_number')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_on_parking_now" value="0">
                            <input class="form-check-input" type="checkbox" id="isOnParkingInput"
                                   name="is_on_parking_now"
                                   value="1" checked>
                            <label class="form-check-label" for="isOnParkingInput">Машина на парковке</label>

                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" Value="Создать">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/imask"></script>

    <script>


        const numberInput = document.getElementById('phoneNumInput');
        const numberMask = new IMask(numberInput, {
            mask: "+{7} (000) 000-00-00",
            lazy: false
        });

    </script>
    <script>


        const gosNumber = document.getElementById('gosNumberInput');
        const gosNumMaskOption = {
            mask: 'a000aa00',
            definitions: {
                'a': /[АВЕКМНОРСТУХABEKMHOPCTYX]/
            },
            lazy: true,
            prepare: function (str) {
                return str.toUpperCase();
            }
        }
        const gosNumMask = new IMask(gosNumber, gosNumMaskOption)
        console.log('maska tut');
    </script>

@endsection
