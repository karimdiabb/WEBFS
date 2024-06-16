<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Dagelijkse Samenvattingen</h1>

        <!-- Formulier om een nieuwe samenvatting te genereren -->
        <div class="mb-6">
            <form method="POST" action="{{ route('order-summary.generate') }}">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Genereer Nieuwe Samenvatting
                </button>
            </form>
        </div>

        <!-- Vue component om bestaande samenvattingen te tonen -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <order-summary :grouped-summaries="{{ json_encode($groupedSummaries) }}"
                :newest-summary="{{ json_encode($newestSummary) }}"></order-summary>
        </div>
    </div>
</x-app-layout>
