@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            
            <h3>Game History</h3>

            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Point</th>
                    <th>Played</th>
                </tr>
                @forelse($histories as $history)
                <tr>
                    <td>{{ $history->user->name }}</td>
                    <td>{{ $history->point > 0 ? '+'.$history->point : $history->point }}</td>
                    <td>{{ $history->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">no data available</td>
                </tr>
                @endforelse
            </table>
            {{ $histories->links() }}
        </div>
    </div>
</div>
@endsection