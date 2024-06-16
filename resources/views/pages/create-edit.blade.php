<x-app-layout>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-5">{{ isset($page) ? 'Pagina Bijwerken' : 'Pagina Aanmaken' }}</h1>
        <page-form :page-id="{{ isset($page) ? $page->id : 'null' }}"
            :page-title="{{ json_encode($page->title ?? '') }}" :page-slug="{{ json_encode($page->slug ?? '') }}"
            :page-content="{{ json_encode($page->content ?? '') }}"></page-form>
    </div>
</x-app-layout>
