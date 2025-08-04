@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Daftar Pengaduan</h2>
    <a href="{{ route('admin.complaints.export') }}" class="btn btn-success mb-3">Export CSV</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Isi Aduan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->id }}</td>
                    <td>{{ $complaint->created_at }}</td>
                    <td>
                        @php
                            $data = json_decode($complaint->data, true);
                        @endphp
                        <ul>
                            @foreach($data as $key => $value)
                                <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada pengaduan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $complaints->links() }}
</div>
@endsection
