<x-app-layout>
    <div class="container mx-auto mt-5">
        <h2 class="text-xl font-bold mb-5">Beheer Menu Afbeeldingen</h2>
        <menu-image-form :current-image1="'{{ $currentImage1 }}'"
            :current-image2="'{{ $currentImage2 }}'"></menu-image-form>
    </div>
</x-app-layout>
