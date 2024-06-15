<x-guest-layout>
    <div id="app">
        <request-help :session-id="{{ $sessionId }}"></request-help>
    </div>

    @vite('resources/js/app.js')
</x-guest-layout>
