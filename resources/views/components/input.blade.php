<div class="form-group">
    @if (isset($label))
       <label for="{{ $name }}" class="{{ $class }}"> {{ $label }} </label>
    @endif
    <input id="{{ $name }}" class="form-control" type="{{ $type }}" placeholder="{{ "Enter " . ucfirst($name) }}" name="{{ $name }}" required>
</div>
