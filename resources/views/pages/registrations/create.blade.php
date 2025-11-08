@extends('layouts.app')

@section('title', 'Buat Registration')

@section('desc', 'Di halaman ini anda bisa membuat registration.')

@section('content')
<form action="{{ route('registrations.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Registration</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="course_id" class="col-sm-3 col-form-label">Course</label>
                        <div class="col-sm-9">
                            <select name="course_id" id="course_id"
                                class="form-control @error('course_id') is-invalid @enderror">
                                <option value="">Pilih Course</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label">User</label>
                        <div class="col-sm-9">
                            <select name="user_id" id="user_id"
                                class="form-control @error('user_id') is-invalid @enderror">
                                <option value="">Pilih User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="whatsapp_number" class="col-sm-3 col-form-label">WhatsApp</label>
                        <div class="col-sm-9">
                            <input value="{{ old('whatsapp_number') }}" type="text"
                                class="form-control @error('whatsapp_number') is-invalid @enderror"
                                name="whatsapp_number" id="whatsapp_number" placeholder="Nomor WhatsApp">
                            @error('whatsapp_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price_paid" class="col-sm-3 col-form-label">Harga Dibayar</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value="{{ old('price_paid') }}" type="number" step="0.01"
                                    class="form-control @error('price_paid') is-invalid @enderror" name="price_paid"
                                    id="price_paid" placeholder="0.00">
                            </div>
                            @error('price_paid')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="purchased" {{ old('status') == 'purchased' ? 'selected' : '' }}>Purchased
                                </option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                            @error('status')
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
    </div>
</form>
@endsection