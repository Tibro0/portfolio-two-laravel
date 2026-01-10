@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | All Professional Journeys
@endsection

@section('css-link')
    {{-- dataTables Css --}}
    <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    {{-- Bootstrap-icons Css --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title border-0 pe-3">All Professional Journeys</div>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-outline-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#mainTitleUpdate">Main Title Update</button>
                        <button type="button" class="btn btn-outline-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Update Title</button>
                        <a href="{{ route('admin.professional-journey.create') }}" class="btn btn-primary px-5">Create
                            New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Year</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($professionalJourneys as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->sub_title }}</td>
                                    <td>
                                        <a href="{{ route('admin.professional-journey.edit', $item->id) }}"
                                            class="btn btn-primary"><i class="lni lni-pencil-alt"></i></a>
                                        <a href="{{ route('admin.professional-journey.destroy', $item->id) }}"
                                            id="delete" class="btn btn-danger"><i class="lni lni-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="alert alert-primary border-0 bg-primary">
                                            <div class="text-white text-center h5">No Data Found!</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('model')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.professional-journey-title-update') }}" method="POST"
                        id="professional-journey-title">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Professional Journey Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="professional_journey_title" class="form-control"
                                    value="{{ old('professional_journey_title') ?? @$title['professional_journey_title'] }}"
                                    placeholder="Professional Journey Title">
                                <div class="invalid-feedback professional_journey_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Professional Journey Description <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="professional_journey_description" class="form-control"
                                    value="{{ old('professional_journey_description') ?? @$title['professional_journey_description'] }}"
                                    placeholder="Professional Journey Description">
                                <div class="invalid-feedback professional_journey_description"></div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Section Title Update Modal -->
    <div class="modal fade" id="mainTitleUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Resume Title Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.resume.main-title.update') }}" method="POST" id="resume-main-title">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Resume Main Title <span class="text-danger">*</span></label>
                                <input type="text" name="resume_main_title" class="form-control"
                                    value="{{ old('resume_main_title') ?? @$title['resume_main_title'] }}"
                                    placeholder="Resume Main Title">
                                <div class="invalid-feedback resume_main_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Resume Sub Title <span class="text-danger">*</span></label>
                                <input type="text" name="resume_sub_title" class="form-control"
                                    value="{{ old('resume_sub_title') ?? @$title['resume_sub_title'] }}"
                                    placeholder="Resume Sub Title">
                                <div class="invalid-feedback resume_sub_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-link')
    {{-- dataTables Js --}}
    <script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <!--sweetalert cdn -->
    <script src="{{ asset('admin/assets/js/sweetalert2@11.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('body').on('click', '#delete', function(event) {
                event.preventDefault();

                let deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,

                            success: function(data) {

                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    window.location.reload();
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Cant Delete',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                })
            })

        })
    </script>
    <script>
        $(document).ready(function() {
            $('#professional-journey-title').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('input').removeClass('is-invalid');
                // Button Disabled
                let submitBtn = $(this).find('button[type="submit"]');
                let originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    type: 'PUT',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message, 'Success');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Check if errors exist
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // professional_journey_title error
                            if (errors.professional_journey_title && errors
                                .professional_journey_title[
                                    0]) {
                                $("input[name='professional_journey_title']").addClass(
                                    'is-invalid');
                                $('.professional_journey_title').text(errors
                                    .professional_journey_title[
                                        0]);
                            }
                            // professional_journey_description error
                            if (errors.professional_journey_description && errors
                                .professional_journey_description[
                                    0]) {
                                $("input[name='professional_journey_description']").addClass(
                                    'is-invalid');
                                $('.professional_journey_description').text(errors
                                    .professional_journey_description[
                                        0]);
                            }
                        }
                        // If no validation errors but general error
                        else if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message, 'Error');
                        }
                        // Unknown error
                        else {
                            toastr.error('Something Went Wrong. Please Try Again Later.',
                                'Error');
                        }
                    },
                    complete: function() {
                        // Button Disabled
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                });
            })

            $('#resume-main-title').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('input').removeClass('is-invalid');
                // Button Disabled
                let submitBtn = $(this).find('button[type="submit"]');
                let originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    type: 'PUT',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message, 'Success');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Check if errors exist
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // resume_main_title error
                            if (errors.resume_main_title && errors
                                .resume_main_title[
                                    0]) {
                                $("input[name='resume_main_title']").addClass(
                                    'is-invalid');
                                $('.resume_main_title').text(errors
                                    .resume_main_title[
                                        0]);
                            }
                            // resume_sub_title error
                            if (errors.resume_sub_title && errors
                                .resume_sub_title[
                                    0]) {
                                $("input[name='resume_sub_title']").addClass(
                                    'is-invalid');
                                $('.resume_sub_title').text(errors
                                    .resume_sub_title[
                                        0]);
                            }
                        }
                        // If no validation errors but general error
                        else if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message, 'Error');
                        }
                        // Unknown error
                        else {
                            toastr.error('Something Went Wrong. Please Try Again Later.',
                                'Error');
                        }
                    },
                    complete: function() {
                        // Button Disabled
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                });
            })
        });
    </script>
@endsection
