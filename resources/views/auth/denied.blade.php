<!DOCTYPE html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
{{-- MAIN --}}
<x-main full-width>
    {{-- The `$slot` goes here --}}
    <x-slot:content>
        <x-alert title="อนุญาตให้เข้าสู่ระบบด้วยอีเมล์มหาวิทยาลัยเท่านั้น" icon="o-exclamation-triangle" class="alert-error text-white">
            <x-slot:actions>
                <x-button no-wire-navigate label="ย้อนกลับ" link="/" />
            </x-slot:actions>
        </x-alert>
    </x-slot:content>
</x-main>
{{--  TOAST area --}}
<x-toast />
</body>
</html>
