@extends('layouts.app')

@section('title', 'Edit Event')
@section('desc', 'Di halaman ini anda bisa edit event.')

@section('content')
<form action="{{ route('events.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Event</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input value="{{ old('title', $item->title) }}" type="text"
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
                                id="description" rows="3">{{ old('description', $item->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="online" {{ old('type', $item->type) == 'online' ? 'selected' : '' }}>
                                    Online</option>
                                <option value="offline" {{ old('type', $item->type) == 'offline' ? 'selected' : '' }}>
                                    Offline</option>
                            </select>
                            @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-sm-3 col-form-label">Start Date</label>
                        <div class="col-sm-9">
                            <input value="{{ old('start_date', $item->start_date->format('Y-m-d\TH:i')) }}"
                                type="datetime-local" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date" id="start_date">
                            @error('start_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end_date" class="col-sm-3 col-form-label">End Date</label>
                        <div class="col-sm-9">
                            <input value="{{ old('end_date', $item->end_date->format('Y-m-d\TH:i')) }}"
                                type="datetime-local" class="form-control @error('end_date') is-invalid @enderror"
                                name="end_date" id="end_date">
                            @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="location" class="col-sm-3 col-form-label">Location</label>
                        <div class="col-sm-9">
                            <input value="{{ old('location', $item->location) }}" type="text"
                                class="form-control @error('location') is-invalid @enderror" name="location"
                                id="location" placeholder="Location (untuk offline)">
                            @error('location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quota" class="col-sm-3 col-form-label">Quota</label>
                        <div class="col-sm-9">
                            <input value="{{ old('quota', $item->quota) }}" type="number"
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
                                <input value="{{ old('price', $item->price) }}" type="number" step="0.01"
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
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Thumbnail</h4>
                </div>
                <div class="card-body">
                    @if($item->thumbnail)
                    <img alt="thumbnail" src="{{ asset('storage/' . $item->thumbnail) }}" class="rounded w-100 mb-3">
                    @endif
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