@extends('layouts.app')

@section('title', 'Редактирование клиента и его машин')

@section('content')

    <div class="container mt-3">
        <div class="row">
            <div class="col-6 border rounded-3">
                <h3>Клиент</h3>
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
                               placeholder="Обязательное поле"
                               value="{{ old('phone_number') ?? $client->phone_number}}">
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
                            <option value="1"
                                {{ $client->gender ? 'selected' : ''}}
                            >Мужчина
                            </option>
                            <option value="0"
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
                <div>
                    <button type="submit" class="btn btn-primary mb-3" form="formClient">Сохранить изменения</button>
                </div>
                <form action="{{ route('clients.delete', $client->id) }}" method="Post">
                    @csrf
                    @method('Delete')
                    <button type="submit" class="btn btn-danger mb-3">Удалить клиента</button>
                </form>
            </div>
        </div>

        @for($i=0; $i < count($cars); $i++)
            <div class="row mt-3">
                @if($cars[$i]->image_id != null)
                    <div class="col align-self-center border rounded-3">
                        <img src="{{ $cars[$i]->preview_url }}" alt="">
                        <form class="d-flex justify-content-center"
                              action="{{ route('cars.deleteImage', $cars[$i]->image_id) }}"
                              method="Post">
                            @csrf
                            @method('Delete')
                            <button type="submit" class="btn btn-danger mb-3 center">Удалить картинку</button>
                        </form>
                    </div>
                @endif
                <div class="col-6 border rounded-3">
                    <h3>{{$i+1}} автомобиль</h3>
                    <form
                        action="{{ route('cars.update', $cars[$i]->car_id) }}"
                        method="Post" id="formAuto{{$i}}">
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
                            <input type="text" class="form-control gos-number-input-class" id="gosNumberInput"
                                   name="gos_number"
                                   placeholder="Обязательное поле"
                                   value="{{ old('gos_number') ?? $cars[$i]->gos_number }}">
                            <div class="text-danger mt-1">
                                @error('gos_number')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_on_parking_now" value="0">
                                <input class="form-check-input" type="checkbox" id="car_is_on_parking" value="1"
                                       name="is_on_parking_now" {{ $cars[$i]->is_on_parking_now ? 'checked' : '' }}>
                                <label class="form-check-label" for="car_is_on_parking">Машина на парковке</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col align-self-end">
                    <div>
                        <button type="submit" class="btn btn-primary mb-3" form="formAuto{{$i}}">Сохранить изменения
                        </button>
                    </div>
                    <form action="{{ route('cars.delete', $cars[$i]->car_id) }}" method="Post">
                        @csrf
                        @method('Delete')
                        <button type="submit" class="btn btn-danger mb-3">Удалить машину</button>
                    </form>
                </div>
            </div>
        @endfor
        <div class="row mt-3">
            <div class="col-6 border rounded-3">
                <h3>Добавить новый автомобиль</h3>
                <form action="{{ route('cars.store', $client->id) }}" id="create_new_auto" method="Post">
                    @csrf
                    <div class="mb-3" id="app">
                        <label for="brandInput" class="form-label">Бренд автомобиля</label>
                        <car-brand-auto-complete></car-brand-auto-complete>
                        <dropzone-component></dropzone-component>
                        <div class="text-danger mt-1">
                            @error('brand')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="modelInput" class="form-label">Модель автомобиля</label>
                        <input type="text" class="form-control" id="modelInput" name="model"
                               placeholder="Обязательное поле" value="{{ old('model') }}">
                        <div class="text-danger mt-1">
                            @error('model')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="colorInput" class="form-label">Цвет автомобиля</label>
                        <input type="text" class="form-control" id="colorInput" name="color_of_carcass"
                               placeholder="Обязательное поле" value="{{ old('color_of_carcass') }}">
                        <div class="text-danger mt-1">
                            @error('color_of_carcass')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gosNumberInput" class="form-label">Государственный номер</label>
                        <input type="text" class="form-control gos-number-input-class" id="gosNumberInput"
                               name="gos_number"
                               placeholder="A001AA34" value="{{ old('gos_number') }}">

                        <div class="text-danger mt-1">
                            @error('gos_number')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="isOnParkingInput">Машина на парковке</label>
                            <input type="hidden" name="is_on_parking_now" value="0">
                            <input class="form-check-input" type="checkbox" id="isOnParkingInput"
                                   name="is_on_parking_now"
                                   value="1" checked>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col align-self-end">
                <button type="submit" class="btn btn-primary mb-3" form="create_new_auto">Добавить</button>
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
        const gosNumberInputs = document.querySelectorAll('.gos-number-input-class');
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
        gosNumberInputs.forEach(gosNumberInput => {
            const gosNumMask = new IMask(gosNumberInput, gosNumMaskOption)


        });
    </script>
@endsection
