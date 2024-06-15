<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('tables.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Registreer een tafel
            </a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold mb-4">Active Table Sessions</h1>
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sessie ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tafel nummer
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Person Birthdates
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deluxe Menu
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Needs Help
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tableSessions as $session)
                            <tr class="{{ $session->needsHelp ? 'bg-red-100' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $session->SessionID }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $session->TableID }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @foreach(json_decode($session->Person_birthdates, true) as $birthdate)
                                        {{ $birthdate }}<br>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $session->Deluxe_menu ? 'Yes' : 'No' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $session->NeedsHelp ? 'Ja' : 'Nee' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($session->NeedsHelp)
                                        <form action="{{ route('help_requests.resolve', $session->SessionID) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                Hulp Verleend
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('table_sessions.destroy', $session->SessionID) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Eindig Sessie
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
