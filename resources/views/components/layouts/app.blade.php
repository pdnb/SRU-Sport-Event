<!DOCTYPE html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="winter">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

{{-- NAVBAR mobile only --}}
<x-nav sticky class="lg:hidden">
    <x-slot:brand>
        <div class="pl-3">
            <img src="{{ asset('assets/logo.png') }}" class="w-8" />
        </div>
    </x-slot:brand>
    <x-slot:actions>
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-icon name="o-bars-3" class="cursor-pointer" />
        </label>
    </x-slot:actions>
</x-nav>

{{-- MAIN --}}
<x-main full-width>
    {{-- SIDEBAR --}}
    <x-slot:sidebar drawer="main-drawer" class="bg-base-100 lg:bg-inherit">

        {{-- BRAND --}}
        <div class="pl-5 pt-5 flex justify-center">
            <img src="{{ asset('assets/logo.png') }}" class="w-20" />
        </div>

        @include('components.layouts.menu')
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content>
        <x-card title="ราชพฤกษ์เกมส์" subtitle="กีฬาบุคลากรมหาวิทยาลัยราชภัฏเขตภาคใต้ ครั้งที่ 6" separator>
            {{ $slot }}
        </x-card>
    </x-slot:content>
</x-main>

{{-- Toast --}}
<x-toast />
@if(!auth()->guest())
    {{-- Here is modal`s ID --}}
    <x-modal id="logoutModal" title="ยืนยันการออกจากระบบ">
        <div></div>

        <x-slot:actions>
            {{-- Notice `onclick` is HTML --}}
            <x-button label="ยืนยัน" class="btn-primary" link="/auth/logout" no-wire-navigate />
            <x-button label="ยกเลิก" onclick="logoutModal.close()" />
        </x-slot:actions>
    </x-modal>
@endif
</body>
</html>
