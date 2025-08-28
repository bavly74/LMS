
<div class="mb-3">
    <label>{{$label}}</label>
    <input type="file"  name="{{$name}}" class="form-control" accept=".jpg,.jpeg"  >
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
