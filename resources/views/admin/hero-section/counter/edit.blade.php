@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | Update Counter
@endsection

@push('css-link')
    {{-- Bootstrap-icons Css --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" />
@endpush

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.counter.update', $counter->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Update Counter</h5>
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label class="form-label">Preview</label><br>
                                    <i class="{{ $counter->icon }} h1"></i>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Icon <span class="text-danger">*</span> (<a
                                            href="https://icons.getbootstrap.com/"
                                            target="_blank">https://icons.getbootstrap.com/</a>)</label>
                                    <input type="text" name="icon"
                                        class="form-control @error('icon') is-invalid @enderror"
                                        value="{{ $counter->icon ?? old('icon') }}" placeholder="Name">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Number <span class="text-danger">*</span></label>
                                    <input type="text" name="number"
                                        class="form-control @error('number') is-invalid @enderror"
                                        value="{{ $counter->number ?? old('number') }}" placeholder="Number">
                                    @error('number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ $counter->title ?? old('title') }}" placeholder="Title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
