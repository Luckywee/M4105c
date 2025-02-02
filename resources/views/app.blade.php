<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="icon" href="../../img/Helpdesk.png">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Auth::check()) 
         <meta name="user_firstname" content="{{ Auth::user()->firstname }}" />
         <meta name="user_lastname" content="{{ Auth::user()->lastname }}" />
         @else
         <meta name="user_firstname" content="Defaut" />
         <meta name="user_lastname" content="Defaut" />
    @endif 

    <title>HelpDesk</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    @routes
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
</head>

<body class="antialiased">
    @inertia
</body>

</html>