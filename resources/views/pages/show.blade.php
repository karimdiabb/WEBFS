<x-guest-layout>
    @push('head')
        <title>{{ $page->title }}</title>
    @endpush
    <div class="container mx-auto p-5 bg-white text-black">
        <h1 class="text-3xl font-bold mb-5">{{ $page->title }}</h1>
        <div>{!! $page->content !!}</div>
    </div>
</x-guest-layout>
