    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success!</strong> {{ session('message') }}
        </div>
    @endif