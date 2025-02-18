@if (isset($login) && $login)
    <div class="form-group">
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
        <input type="{{ $type }}" onKeyPress="if(this.value.length=={{ $max }})return false;"
            min="0" class="form-control form-control-lg" id="{{ $name }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
        <div class="invalid-feedback">{{ $error ? $error : '' }}</div>
        <div class="help-block">{{ $help ? $help : '' }}</div>
    </div>
@elseif (isset($textarea) && $textarea)
    <div class="col-md-{{ $col }} mb-3">
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
        <textarea onKeyPress="if(this.value.length==1000)return false;" class="form-control" id="{{ $name }}"
            name="{{ $name }}" rows="5" style="height: 77px;" {{ $required ? 'required' : '' }}></textarea>
    </div>
@elseif (isset($file) && $file)
    <div class="col-md-12" id="archivoBase64"></div>
    <label class="form-label" for="archivo">{{ $title }}</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="archivo" name="archivo" accept="{{ $accept }}"
                required>
            <label class="custom-file-label" for=archivo">{{ $label }}</label>
        </div>
    </div>
    <span class="help-block">{{ $span }}</span>
@else
    <div class="col-md-{{ $col }} mb-3">
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
        <input type="{{ $type }}" onKeyPress="if(this.value.length=={{ $max }})return false;"
            class="form-control" id="{{ $name }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
    </div>
@endif
