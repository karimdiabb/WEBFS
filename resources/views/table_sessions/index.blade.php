<x-guest-layout>
    <div id="app">
        <div class="container">
            <h1>Active Table Sessions</h1>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Session ID</th>
                        <th>Table ID</th>
                        <th>Person Birthdates</th>
                        <th>Deluxe Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tableSessions as $session)
                        <tr>
                            <td>{{ $session->SessionID }}</td>
                            <td>{{ $session->TableID }}</td>
                            <td>
                                @foreach(json_decode($session->Person_birthdates, true) as $birthdate)
                                    {{ $birthdate }}<br>
                                @endforeach
                            </td>
                            <td>{{ $session->Deluxe_menu ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-guest-layout>