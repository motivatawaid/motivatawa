@extends('layouts.app')

@section('title', 'Buat Video')
@section('desc', 'Di halaman ini anda bisa membuat video.')

@section('content')
<form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Video</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
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
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                id="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value="{{ old('price') }}" type="number" step="0.01"
                                    class="form-control @error('price') is-invalid @enderror" name="price" id="price"
                                    placeholder="0.00">
                            </div>
                            @error('price')
                            <div class="invalid-feedback">
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
                    <h4>Video File</h4>
                </div>
                <div class="card-body">
                    <div class="clearfix"></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="video_file" name="video_file" accept="video/*">
                        <label class="custom-file-label" for="video_file">Pilih Video File</label>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Thumbnail</h4>
                </div>
                <div class="card-body">
                    <div class="clearfix"></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" accept="image/*">
                        <label class="custom-file-label" for="thumbnail">Pilih Thumbnail</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection