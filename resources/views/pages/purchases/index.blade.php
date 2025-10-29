@extends('layouts.app')

@section('title', 'Kelola Purchases')
@section('desc', 'Di halaman ini anda bisa kelola purchases.')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>List Purchases</h4>
        <div class="card-header-action">
            <a href="{{ route('purchases.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped w-100" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Video Title</th>
                        <th>User Name</th>
                        <th>Harga Dibayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var datatable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: "{!! url()->current() !!}"
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'ALL']
            ],
            responsive: true,
            order: [
                [0, 'desc'],
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'video_title', name: 'video_title'},
                {data: 'user_name', name: 'user_name'},
                {data: 'price_paid', name: 'price_paid'},
                {data: 'status', name: 'status'},
                {data: 'aksi', name: 'aksi', orderable: false, searchable: false},
            ],
            rowId: function(a) {
                return a.id;
            },
            rowCallback: function(row, data, iDisplayIndex) {
                var api = this.api();
                var info = api.page.info();
                var page = info.page;
                var length = info.length;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            },
        });
    });
</script>
@endpush