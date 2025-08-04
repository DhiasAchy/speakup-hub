@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">🛠️ Form Builder</h2>

    <div id="build-wrap" style="min-height: 300px; border: 1px solid #ddd; background: #f9f9f9;"></div>
    <button class="btn btn-success mt-3 save-btn">Save Form</button>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.8.5/form-builder.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

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
        });
    </script>
@endpush
