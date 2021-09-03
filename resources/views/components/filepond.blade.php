@props([
    'name',
    'uploadUrl',
])

<div
    {{ $attributes }}
    x-data
    x-init="
        () => {
            const pond = FilePond.create($refs.input);
            pond.setOptions({
                server: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    process: {
                        url: '{{ $uploadUrl }}',
                    },
                    revert: null,
                },
                {{-- FilePond Core Properties --}}
                labelTapToUndo: '',
                maxParallelUploads: {{ $attributes->has('max-parallel-uploads') ? $attributes->get('max-parallel-uploads') : 1 }},
                allowMultiple: {{ $attributes->has('allow-multiple-uploads') ? 'true' : 'false' }},
                maxFiles: {{ $attributes->has('max-files-uploads') ? $attributes->get('max-files-uploads') : 'null' }},
                stylePanelLayout: '{{ $attributes->has('avatar-style') ? 'compact circle' : '' }}',
                {{-- FilePond Plugins Properties --}}
                allowFileSizeValidation: {{ $attributes->has('file-size-validation') ? 'true' : 'false' }},
                maxFileSize: '{{ $attributes->has('file-size-validation') ? $attributes->get('file-size-validation') : '' }}',
                allowFileTypeValidation: {{ $attributes->has('file-type-validation') ? 'true' : 'false' }},
                acceptedFileTypes: '{{ $attributes->has('file-type-validation') ? $attributes->get('file-type-validation') : '' }}',
                allowImageExifOrientation: {{ $attributes->has('correct-image-orientation') ? 'true' : 'false' }},
                allowImageCrop: {{ $attributes->has('crop-aspect-ratio') ? 'true' : 'false' }},
                imageCropAspectRatio: '{{ $attributes->has('crop-aspect-ratio') ? $attributes->get('crop-aspect-ratio') : '' }}',
            });

            pond.on('warning', (error) => {
                alert(error.body + '. Allowed: {{ $attributes->get('max-files-uploads') }}');
            });

            pond.on('error', (error, file) => {
                if (error.main == 'File is too large') {
                    alert(error.sub);
                }

                if (error.type == 'error') {
                    alert(error.body);
                }
            });

            pond.on('processfiles', (files) => {
                Livewire.emit('image-uploaded');

                if ({{ $attributes->has('clear-after-upload') ? 'true' : 'false' }}) {
                    var pond_ids = [];

                    pond.getFiles().forEach(function(file) {
                        pond_ids.push(file.id);
                    });

                    pond.removeFiles(pond_ids);
                }
            });
        }
    "
>
    <x-input
        x-ref="input"
        type="file"
        name="{{ $name }}"
    />
</div>

@push('styles')
    @once
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
        @if ($attributes->has('grid-style'))
            <style>
                .filepond--item {
                    width: calc(50% - 0.5em);
                }

                .filepond--file-action-button {
                    display: none;
                }

                @media (min-width: 30em) {
                    .filepond--item {
                        width: calc(50% - 0.5em);
                    }
                }

                @media (min-width: 50em) {
                    .filepond--item {
                        width: calc(33.33% - 0.5em);
                    }
                }
            </style>
        @endif
    @endonce
@endpush

@push('scripts')
    @once
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script>
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImageCrop,
            );
        </script>
    @endonce
@endpush
