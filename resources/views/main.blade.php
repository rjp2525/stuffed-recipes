<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
{!! str_replace('<title>','<title inertia>', Meta::toHtml()) !!}
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
