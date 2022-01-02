@section('head')

    <head>

        {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!-- All the files that are required -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{ mix('js/productDelete.js') }}"></script>
        <script src="{{ mix('js/productList.js') }}"></script>
        <script src="{{ mix('js/productSearch.js') }}"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}
    </head>

@endsection
