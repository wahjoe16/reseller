@extends('layouts.admin.master')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Add New Category</p>
                    </div>
                </div>
                <form action="{{ route('categories.store') }}" method="post">@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Title</label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Parent Category</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="">Select</option>
                                        @foreach ($data as $d)
                                        <option value="{{ $d->id }}">
                                            {{ $d->title  }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Save</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('bottom_scripts')
<script>

</script>
@endpush