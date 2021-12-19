<div class="form-group">
    @if (isset($label))
       <label for="{{ $name }}" class="{{ $class }}"> {{ $label }} </label>
    @endif
    <input id="{{ $name }}" class="form-control {{ isset($inputcss) ? $inputcss : ""}}" type="{{ $type }}"
     placeholder="{{ "Enter " . ucfirst($name) }}" name="{{ $name }}" value="{{ $type == 'submit' ? $name : "" }}" required>
</div>
