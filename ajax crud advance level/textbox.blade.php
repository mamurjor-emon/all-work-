<div class="mb-3">
    @if(!empty($labelName))<label for="{{ $name }}" class="{{ $required ?? '' }} {{ $labelClass ?? '' }} label-text">{{ $labelName }}</label>@endif

    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" class="form-control from-control-sm {{ $class ?? '' }}" value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" @if(!empty($accept)) accept="{{ $accept }}" @endif maxlength="{{ $maxlength ?? '' }}"  @if(!empty($onchange)) onchange="{{ $onchange }}" @endif @if(!empty($readonly)) readonly @endif @if(!empty($multiple)) multiple="multiple" @endif @if(!empty($required_field)) required="" @endif data-action_id="{{ $data ?? '' }}">

    @if(!empty($optionalText))<span style="background: #e9fff7; font-size: 12px; cursor: help;" class="py-1 px-2 d-block">{{ $optionalText }}</span>@endif

    @if(!empty($errorInput))
        @error($errorInput)
            <span class="text-danger error-msg">{{ $message }}</span>
        @enderror
    @endif
</div>

