@extends('layouts.app')

@section('title', 'Buat Course')

@section('desc', 'Di halaman ini anda bisa membuat course.')

@section('content')
<form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Course</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Course</label>
                        <div class="col-sm-9">
                            <input value="{{ old('name') }}" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                placeholder="Nama Course">
                            @error('name')
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
                        <label for="quota" class="col-sm-3 col-form-label">Kuota</label>
                        <div class="col-sm-9">
                            <input value="{{ old('quota') }}" type="number"
                                class="form-control @error('quota') is-invalid @enderror" name="quota" id="quota"
                                placeholder="0">
                            @error('quota')
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