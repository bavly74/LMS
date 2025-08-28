
<div class="mb-3">
    <label>{{$label}}</label>
    <input type="{{$type}}" value="{{ $value ?? old($name)}}" name="{{$name}}" class="form-control" placeholder="{{$placeholder}}" >
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
