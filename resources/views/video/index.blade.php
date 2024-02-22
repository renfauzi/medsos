<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Video </title>
    <style>
        /* Custom CSS */
        .video-container {
            width: 320px; /* Adjust the width as per your design */
            height: 560px; /* Adjust the height as per your design */
            margin: 0 auto; /* Center align the video container */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Video </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- You can add more navbar items here if needed -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <h2 class="text-center">Feed</h2>
        @foreach ($videos as $video)
            <div class="video-container position-relative d-inline-block">
                <video width="320" height="560" controls class="card-img-top">
                    <source src="{{ asset('/storage/'.$video->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <form action="{{ route('video.destroy',$video->id) }}" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin video ini?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
                <div>{{ $video->created_at->format('d F Y') }}</div>
                <div>{{ $video->caption }}</div>
            </div>
            <br>
        @endforeach
        <div class="container mt-3 text-center">
            <a class="btn btn-success mr-2 d-inline-block" href="{{ route('video.create') }}">Add</a> <!-- Tombol "Add" -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline-block">
                @csrf
                <button class="btn btn-warning" type="submit">{{ __('Logout') }}</button> <!-- Tombol "Logout" -->
            </form>
        </div>
        <div class="container mt-3 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    @if($videos->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{ $videos->previousPageUrl() }}">{{ $videos->currentPage() - 1 }}</a></li>
                    @endif

                    <li class="page-item active"><a class="page-link" href="#">{{ $videos->currentPage() }}</a></li>

                    @if($videos->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $videos->nextPageUrl() }}">{{ $videos->currentPage() + 1 }}</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>


    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
