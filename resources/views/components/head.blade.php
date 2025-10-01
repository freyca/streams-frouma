<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Fran Rey">
    <meta name="robots" content="noindex">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="/images/favicon.png" type="image/png" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>