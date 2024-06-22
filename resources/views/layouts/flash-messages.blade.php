@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! implode('', $errors->all('<div>:message</div>')) !!}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(flash()->message)
    @if(flash()->level === 'success')
        <script>
            $(function(){
                toastr.success("{{ flash()->message }}");
            })
        </script>
    @endif

    @if(flash()->level === 'error')
        <script>
            $(function(){
                toastr.error("{{ flash()->message }}");
            })
        </script>
    @endif

    @if(flash()->level === 'warning')
        <script>
            $(function(){
                toastr.warning("{{ flash()->message }}");
            })
        </script>
    @endif

    @if(flash()->level === 'info')
        <script>
            $(function(){
                toastr.info("{{ flash()->message }}");
            })
        </script>
    @endif
@endif