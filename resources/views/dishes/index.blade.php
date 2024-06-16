<x-guest-layout>
    <div id="app" class="container mx-auto p-6">
        <favorite-dishes :dishes="{{ json_encode($dishes) }}"></favorite-dishes>
    </div>

    @vite('resources/js/app.js')
</x-guest-layout>
