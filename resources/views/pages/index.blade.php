<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body>
    <div id="app">
        <main-component></main-component>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
