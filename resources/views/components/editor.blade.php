@if(!config('website.pjax'))
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css">
@endpush

@push('style')
<style>
    .trumbowyg-box,.trumbowyg-editor {min-height: 150px !important;}
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/trumbowyg.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/plugins/upload/trumbowyg.upload.min.js"></script>
@endpush
@endif

@push('javascript')
<script>
$('.editor').trumbowyg({
    btns: [
        ['viewHTML'],
        ['formatting'],
        ['strong', 'em', 'del'],
        ['upload'], // Our fresh created dropdown
        ['link'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['removeformat'],
        ['fullscreen']
    ],
    plugins: {
        upload: {
            serverPath: '{{ route("upload") }}',
            fileFieldName: 'image',
            data: [{
                name: 'myKey1'
            }],
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            urlPropertyName: 'url'
        }
    }
});

$('.simple').trumbowyg({
    btns: ['strong', 'em','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','unorderedList', 'orderedList','removeformat']
});
</script>
@endpush