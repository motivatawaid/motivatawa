@extends('layouts.app')

@section('title', 'Buat News')
@section('desc', 'Di halaman ini anda bisa membuat news.')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Buat News</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input value="{{ old('title') }}" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                                placeholder="Title">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article" class="col-sm-2 col-form-label">Article</label>
                        <div class="col-sm-10">
                            <div id="editor" class="ql-container @error('article') border-danger @enderror"></div>
                            <input type="hidden" name="article" id="article-hidden">
                            @error('article')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Thumbnail</h4>
                </div>
                <div class="card-body">
                    <div class="clearfix"></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                        <label class="custom-file-label" for="thumbnail">Pilih Thumbnail</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Tulis artikel Anda di sini...',
        {{--  modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                ['list', 'bullet'],
                ['link'],
                [{ 'align': [] }],
                ['clean']
            ]
        }  --}}
    });

    quill.on('text-change', function() {
        document.getElementById('article-hidden').value = quill.root.innerHTML;
    });

    // Set initial value if old input exists
    @if(old('article'))
        quill.root.innerHTML = @json(old('article'));
        document.getElementById('article-hidden').value = @json(old('article'));
    @endif
</script>
@endpush