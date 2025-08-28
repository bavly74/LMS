<div class="mb-3">
    <div class="form-label text-capitalize">{{$label}}</div>
    <label class="form-check form-switch form-switch-2">
        <input name="{{$name}}" @checked($checked) value="1" class="form-check-input" type="checkbox">
        <x-input-error :messages="$errors->get($name)" class="mt-2" />

    </label>
</div>
