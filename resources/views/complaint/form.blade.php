<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SpeakUp Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .logo {
      width: 70px;
      height: 70px;
      background: #007bff;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 30px;
      color: white;
      margin: 0 auto 20px;
    }
  </style>
</head>
<body>
<div class="card p-5 col-md-5 col-sm-10 bg-white">
  <div class="logo">💬</div>
  <h3 class="text-center mb-4">SpeakUp Hub</h3>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <form action="{{ route('complaint.store') }}" method="POST">
    @csrf
    @foreach ($fields as $field)
        <div class="mb-3">
            <label>{{ $field->label }}</label>
            @if ($field->type == 'textarea')
            <textarea name="{{ $field->name }}" class="form-control" {{ $field->required ? 'required' : '' }}></textarea>
            @else
            <input type="{{ $field->type }}" name="{{ $field->name }}" class="form-control" {{ $field->required ? 'required' : '' }}>
            @endif
        </div>
    @endforeach
    <button class="btn btn-primary w-100">Kirim Aduan</button>
  </form>
</div>
</body>
</html>
