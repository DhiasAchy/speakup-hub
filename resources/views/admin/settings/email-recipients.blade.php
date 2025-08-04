@extends('layouts.admin')

@section('content')
<h3>Email Recipients</h3>

<form method="POST" action="{{ route('admin.settings.email-recipients.store') }}">
    @csrf
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Recipient</button>
</form>

<hr>
<h4>Current Recipients</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recipients as $recipient)
            <tr>
                <td>{{ $recipient->email }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.settings.email-recipients.destroy', $recipient->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
