<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.8.5/form-builder.min.css" />
    
    <style>
        body { font-family: sans-serif; margin: 20px; }
        #build-wrap { padding: 10px; min-height: 250px; border: 1px solid #ddd; background: #f9f9f9; }
        button { padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px; }
        .save-btn { background: #007bff; color: white; }
        .preview-btn { background: #28a745; color: white; margin-left: 5px; }
        #preview-wrap { margin-top: 20px; padding: 15px; border: 1px solid #ccc; background: #fff; }
        h3 { margin-top: 30px; }
    </style>
</head>
<body>
    <h2>SpeakUp Hub - Form Builder</h2>
    <div id="build-wrap"></div>
    <button class="save-btn">Save Form</button>
    <button class="preview-btn">Preview</button>

    <h3>Live Preview</h3>
    <div id="preview-wrap">Form preview will appear here...</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

    <script>
        jQuery($ => {
            const fbEditor = document.getElementById('build-wrap');
            const formBuilder = $(fbEditor).formBuilder({
                formData: {!! json_encode($design->json_schema ?? '[]') !!}
            });

            $('.save-btn').click(function() {
                const schema = formBuilder.actions.getData('json');
                $.post("{{ route('admin.form-builder.save') }}", {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    schema: schema
                }, function(res){
                    alert('Form berhasil disimpan!');
                });
            });

            $('.preview-btn').click(function() {
                const schema = formBuilder.actions.getData('json');
                $('#preview-wrap').formRender({ formData: schema });
            });
        });
    </script>
</body>
</html>
