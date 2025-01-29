<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<style>
    body {
        background-image: url('{{ asset('/librofondo2.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
    }
</style>
<body class="py-10 ">
   @yield('content')
</body>

</html>
