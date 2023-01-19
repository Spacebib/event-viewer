<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="EventViewer">
    <title>EventViewer</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,600' rel='stylesheet'
          type='text/css'>
    <link href="{{ asset(mix('app.css', 'vendor/event-viewer')) }}" rel="stylesheet">
</head>
<body class="bg-[#ebebeb]">
<div class="px-6 sm:px-16">
    <nav class="flex border-b border-solid border-gray-300 py-4">
        <h4 class="text-4xl font-semibold">EventViewer - {{ config('app.name') }}</h4>
    </nav>

    <main role="main" class="pt-3">
        <div id="event-viewer"></div>
    </main>
</div>
<script src="{{asset(mix('app.js', 'vendor/event-viewer'))}}"></script>
</body>
</html>
