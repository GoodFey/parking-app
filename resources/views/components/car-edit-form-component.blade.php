@if($car->image_id != null)
    <div class="col align-self-center border rounded-3">
        <img src="{{ $car->preview_url }}" alt="">
        <form class="d-flex justify-content-center"
              action="{{ route('cars.deleteImage', $car->image_id) }}"
              method="Post">
            @csrf
            @method('Delete')
            <button type="submit" class="btn btn-danger mb-3 center">Удалить картинку</button>
        </form>
    </div>
@endif
<div class="col align-self-center border rounded-3" id="app">
    <dropzone-component></dropzone-component>
</div>

<div class="col-6 border rounded-3">
    <h3>{{$i+1}} автомобиль</h3>
    <form
        action="{{ route('cars.update', $car->car_id) }}"
        method="Post" id="formAuto{{$i}}">
        @csrf
        @method('Patch')
        <div class="mb-3">
            <label for="brandCarInput" class="form-label">Бренд автомобиля</label>
            <input type="text" class="form-control" id="brandCarInput" name="brand"
                   placeholder="Обязательное поле" value="{{ old('brand') ?? $car->brand }}">
            <div class="text-danger mt-1">
                @error('brand')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="modelCarInput" class="form-label">Модель автомобиля</label>
            <input type="text" class="form-control" id="modelCarInput" name="model"
                   placeholder="Обязательное поле" value="{{ old('model') ?? $car->model }}">
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
                   value="{{ old('color_of_carcass') ?? $car->color_of_carcass }}">
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
                   value="{{ old('gos_number') ?? $car->gos_number }}">
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
                       name="is_on_parking_now" {{ $car->is_on_parking_now ? 'checked' : '' }}>
                <label class="form-check-label" for="car_is_on_parking">Машина на парковке</label>
            </div>
        </div>
    </form>
</div>
<div class="col align-self-end">
    @if($car->image_id == null)
        <div>
            <button type="submit" class="btn btn-info mb-3">Добавить картинку</button>
        </div>
    @endif
    <div>
        <button type="submit" class="btn btn-primary mb-3" form="formAuto{{$i}}">Сохранить изменения</button>
    </div>
    <form action="{{ route('cars.delete', $car->car_id) }}" method="Post">
        @csrf
        @method('Delete')
        <button type="submit" class="btn btn-danger mb-3">Удалить машину</button>
    </form>
</div>
