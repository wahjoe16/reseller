@extends('layouts.admin.master')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>{{ $title }}</h6>
                    <div class="btn-group">
                        <a href="{{ route('categories.create') }}" class="btn btn-success btn-xs"><i class="ni ni-app"></i> Add</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-categories">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Parent Category</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('bottom_scripts')
<script>
    let table;

    $(function() {
        table = $('.table-categories').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("categories.data") }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                }, {
                    data: 'title'
                },
                {
                    data: 'parent.title'
                }, {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ]
        });
    });
</script>
@endpush