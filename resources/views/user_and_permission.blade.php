<x-cube.auth.layout title="Users and Permissions">

    @if (session('success'))
        <x-cube.alert type="success" message="{{ session('success') }}"></x-cube.alert>
    @endif

</x-cube.auth.layout>
