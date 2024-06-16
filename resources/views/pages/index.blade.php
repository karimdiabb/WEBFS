<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">Pagina's</h1>
            <a href="{{ route('pages.create') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">Pagina Aanmaken</a>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th scope="col"
                            class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titel
                        </th>
                        <th scope="col"
                            class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL
                        </th>
                        <th scope="col"
                            class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acties</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($pages as $page)
                        <tr>
                            <td class="py-4 px-6">{{ $page->title }}</td>
                            <td class="py-4 px-6">
                                <a href="{{ route('pages.show', $page->slug) }}" target="_blank"
                                    class="text-blue-500 underline">{{ url($page->slug) }}</a>
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('pages.edit', $page->id) }}"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700">Bewerken</a>
                                <form action="{{ route('pages.destroy', $page->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700"
                                        onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
