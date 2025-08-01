<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.8.5/form-render.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* body { font-family: sans-serif; margin: 20px; background: #f7f7f7; } */
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        .btn-submit { background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer; margin-top: 10px; }
        .alert { background: #d4edda; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb; color: #155724; }

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
    {{-- <div class="container">
        <h2>SpeakUp Hub - Form Pengaduan</h2>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('complain.submit') }}" id="dynamic-form">
            @csrf
            <div id="render-wrap"></div>
            <button type="submit" class="btn-submit">Kirim Pengaduan</button>
        </form>
    </div> --}}

    <div class="card p-2 p-lg-4 col-12 col-md-5 bg-white">
        <div class="logo">💬</div>
        <h1 class="text-center">SpeakUp Hub</h1>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('complain.submit') }}" method="POST" id="dynamic-form">
            @csrf
            <div id="render-wrap"></div>
            <button type="submit" class="btn btn-primary w-100">Kirim Aduan</button>

        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

    <script>
        jQuery($ => {
            const formData = {!! json_encode($design->json_schema ?? '[]') !!};
            $('#render-wrap').formRender({ formData });
        });
    </script>
</body>
</html>