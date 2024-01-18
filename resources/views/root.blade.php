<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	@spladeHead
	@vite('resources/js/app.js')
</head>

<body class="font-sans !text-xs antialiased h-screen w-screen">
	@splade
</body>

</html>