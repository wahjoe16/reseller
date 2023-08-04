@extends('layouts.admin.master')

@push('up_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<style>
    .mt-100 {
        margin-top: 100px
    }

    body {
        background: #00B4DB;
        background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
        background: linear-gradient(to right, #0083B0, #00B4DB);
        color: #514B64;
        min-height: 100vh
    }
</style>
@endpush

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Update Data Product</p>
                    </div>
                </div>
                <form action="{{ route('products-reseller.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category" class="form-control-label">Category</label>
                                    <select class="form-control" name="category[]" id="category" placeholder="Select Categories" multiple>
                                        <option value="">Select</option>
                                        @foreach ($category as $c)
                                        <option value="{{ $c->id }}" @foreach ($data->categories as $item)
                                            @if (in_array($c->id, old('category', [$item->id])))
                                            selected="selected"
                                            @endif
                                            @endforeach
                                            >{{ $c->title  }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Product Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ $data->name }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="model" class="form-control-label">Product Model</label>
                                    <input class="form-control" type="text" name="model" value="{{ $data->model }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Product price</label>
                                    <input class="form-control" type="numeric" name="price" value="{{ $data->price }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo" class="form-control-label">Product Photo <sub>(jpg, png)</sub></label>
                                    <div class="custom-file">
                                        <input type="file" name="photo" id="photo" class="custom-file-input">
                                    </div>
                                    @if (isset($data) && $data->photo !== '')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Current Photo</p>
                                            <div class="d-flex px-2 py-1">
                                                <img src="{{ url('/img/products/' . $data->photo) }}" alt="" width="180">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Save</button>
                                    <a href="{{ route('products-reseller.index') }}" class="btn btn-light">Cancel</a>
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
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script>
    $(document).ready(function() {

        var multipleCancelButton = new Choices('#category', {
            removeItemButton: true,
            maxItemCount: 5,
            searchResultLimit: 5,
            renderChoiceLimit: 5
        });


    });
</script>
@endpush