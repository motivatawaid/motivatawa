@extends('layouts.app')

@section('title', 'Edit Ticket')
@section('desc', 'Di halaman ini anda bisa edit ticket.')

@section('content')
<form action="{{ route('tickets.update', $item->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Ticket</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="event_id" class="col-sm-3 col-form-label">Event</label>
                        <div class="col-sm-9">
                            <select name="event_id" id="event_id"
                                class="form-control @error('event_id') is-invalid @enderror">
                                <option value="">Pilih Event</option>
                                @foreach($events as $event)
                                <option value="{{ $event->id }}"
                                    {{ old('event_id', $item->event_id) == $event->id ? 'selected' : '' }}>
                                    {{ $event->title }}</option>
                                @endforeach
                            </select>
                            @error('event_id')
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
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
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
                        <label for="price_paid" class="col-sm-3 col-form-label">Harga Dibayar</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value="{{ old('price_paid', $item->price_paid) }}" type="number" step="0.01"
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
                                <option value="pending"
                                    {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="purchased"
                                    {{ old('status', $item->status) == 'purchased' ? 'selected' : '' }}>Purchased
                                </option>
                                <option value="cancelled"
                                    {{ old('status', $item->status) == 'cancelled' ? 'selected' : '' }}>Cancelled
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
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection