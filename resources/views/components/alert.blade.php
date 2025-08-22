@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 mb-4" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
    {{ session('success') }}</button>
    </div>       
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
    {{ session('error') }}</button>
    </div>       
@endif

@if ($errors->any())
     <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif