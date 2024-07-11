@if (session('success'))
    {{-- <div class="alert alert-success" role="alert">
    {{ session('success') }}
</div> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Pronto!',
                html: '{{ session('success') }}',
                icon: 'success'
            });
        });
    </script>
@endif

@if (session('error'))
    {{-- <div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Erro:',
                html: '{{ session('error') }}',
                icon: 'error'
            });
        });
    </script>
@endif

@if ($errors->any())
    @php
        $message = '';
        foreach ($errors->all() as $error) {
            $message .= $error . '<br>';
        }
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Erro:',
                html: '{!! $message !!}',
                icon: 'error'
            });
        });
    </script>
{{-- <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div> --}}
@endif