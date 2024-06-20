@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! implode('', $errors->all('<div>:message</div>')) !!}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(flash()->message)
    @if(flash()->level === 'success')
        <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ flash()->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(flash()->level === 'error')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ flash()->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(flash()->level === 'warning')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ flash()->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(flash()->level === 'info')
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif

<div id="flash-message-response" ></div>