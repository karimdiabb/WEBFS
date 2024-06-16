<x-app-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-xl font-bold mb-5">Menu Afbeeldingen</h2>
        <a href="{{ route('menu.createOrEdit') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Beheer
            Afbeeldingen</a>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            @foreach ($images as $image)
                <div class="border p-4">
                    <img src="{{ url('images/menu/' . $image->getFilename()) }}" alt="Menu Image" class="w-full h-auto">
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
