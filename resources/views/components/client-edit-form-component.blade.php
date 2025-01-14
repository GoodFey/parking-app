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
