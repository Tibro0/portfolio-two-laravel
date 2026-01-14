@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | All Academic Excellences
@endsection

@push('css-link')
    {{-- dataTables Css --}}
    <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    {{-- Bootstrap-icons Css --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" />
@endpush

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center">
                    <div class="breadcrumb-title border-0 pe-3">All Academic Excellences</div>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-outline-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Update Title</button>
                        <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#academic-excellence-create-modal">Create New</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
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
                            @forelse ($academicExcellences as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->sub_title }}</td>
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-id="{{ $item->id }}"><i
                                                class="lni lni-pencil-alt"></i></button>
                                        <a href="{{ route('admin.academic-excellence.destroy', $item->id) }}" id="delete"
                                            class="btn btn-danger"><i class="lni lni-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
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

@push('model')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.academic-excellences-title-update') }}" method="POST"
                        id="academic-excellences-title">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Academic Excellences Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="academic_excellences_title" class="form-control"
                                    value="{{ old('academic_excellences_title') ?? @$title['academic_excellences_title'] }}"
                                    placeholder="Academic Excellences Title">
                                <div class="invalid-feedback academic_excellences_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Academic Excellences Description <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="academic_excellences_description" class="form-control"
                                    value="{{ old('academic_excellences_description') ?? @$title['academic_excellences_description'] }}"
                                    placeholder="Academic Excellences Description">
                                <div class="invalid-feedback academic_excellences_description"></div>
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

    <!-- Academic Excellence Create Modal -->
    <div class="modal fade" id="academic-excellence-create-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Professional Journey</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.academic-excellence.store') }}" method="POST"
                        id="academic-excellence-create-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Year <span class="text-danger">*</span></label>
                                <input type="text" name="year" class="form-control" value="{{ old('year') }}"
                                    placeholder="Year">
                                <div class="invalid-feedback year"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    placeholder="Title">
                                <div class="invalid-feedback title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Sub Title <span class="text-danger">*</span></label>
                                <input type="text" name="sub_title" class="form-control"
                                    value="{{ old('sub_title') }}" placeholder="Sub Title">
                                <div class="invalid-feedback sub_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                                <div class="invalid-feedback description"></div>
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

    <!-- Update Academic Excellence Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Academic Excellence</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editModalForm">
                        <input type="hidden" name="id">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Year <span class="text-danger">*</span></label>
                                <input type="text" name="year" class="form-control" value="{{ old('year') }}"
                                    placeholder="Year">
                                <div class="invalid-feedback year"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    placeholder="Title">
                                <div class="invalid-feedback title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Sub Title <span class="text-danger">*</span></label>
                                <input type="text" name="sub_title" class="form-control"
                                    value="{{ old('sub_title') }}" placeholder="Sub Title">
                                <div class="invalid-feedback sub_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                                <div class="invalid-feedback description"></div>
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
@endpush

@push('js-link')
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
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 3000);
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
            $('#academic-excellences-title').on('submit', function(e) {
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
                            // academic_excellences_title error
                            if (errors.academic_excellences_title && errors
                                .academic_excellences_title[
                                    0]) {
                                $("input[name='academic_excellences_title']").addClass(
                                    'is-invalid');
                                $('.academic_excellences_title').text(errors
                                    .academic_excellences_title[
                                        0]);
                            }
                            // academic_excellences_description error
                            if (errors.academic_excellences_description && errors
                                .academic_excellences_description[
                                    0]) {
                                $("input[name='academic_excellences_description']").addClass(
                                    'is-invalid');
                                $('.academic_excellences_description').text(errors
                                    .academic_excellences_description[
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
    <script>
        $(document).ready(function() {
            // Create Academic Excellence
            $('#academic-excellence-create-form').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('input, textarea').removeClass('is-invalid');
                // Button Disabled
                let submitBtn = $(this).find('button[type="submit"]');
                let originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message, 'Success');
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Check if errors exist
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // year error
                            if (errors.year && errors.year[0]) {
                                $("input[name='year']").addClass('is-invalid');
                                $('.year').text(errors.year[0]);
                            }
                            // title error
                            if (errors.title && errors.title[0]) {
                                $("input[name='title']").addClass('is-invalid');
                                $('.title').text(errors.title[0]);
                            }
                            // sub_title error
                            if (errors.sub_title && errors.sub_title[0]) {
                                $("input[name='sub_title']").addClass('is-invalid');
                                $('.sub_title').text(errors.sub_title[0]);
                            }
                            // description error
                            if (errors.description && errors.description[0]) {
                                $("textarea[name='description']").addClass('is-invalid');
                                $('.description').text(errors.description[0]);
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
    <script>
        $(document).ready(function() {
            // Edit Button Click
            $('.edit-btn').on('click', function() {
                let id = $(this).data('id');
                openEditModal(id);
            });

            // Open Edit Modal with Data
            function openEditModal(id) {
                // Show modal
                $('#editModal').modal('show');

                // Fetch data via AJAX
                $.ajax({
                    url: '{{ route('admin.academic-excellence.edit', ':id') }}'.replace(":id", id),
                    type: 'GET',
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            $("input[name='id']").val(data.academicExcellence.id);
                            $("input[name='year']").val(data.academicExcellence.year);
                            $("input[name='title']").val(data.academicExcellence.title);
                            $("input[name='sub_title']").val(data.academicExcellence.sub_title);
                            $("textarea[name='description']").val(data.academicExcellence.description);
                        }
                    },
                    error: function(xhr) {
                        $('#editModal').modal('hide');
                        toastr.error('Something Went Wrong. Please Try Again Later', 'Error');
                    }
                });
            }

            // Edit Form Submission
            $('#editModalForm').submit(function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('input').removeClass('is-invalid');
                // Button Disabled
                let submitBtn = $(this).find('button[type="submit"]');
                let originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Saving...');

                // Send AJAX request
                $.ajax({
                    url: '{{ route('admin.academic-excellence.update', ':id') }}'.replace(":id",
                        $("input[name='id']").val()),
                    type: 'PUT',
                    data: $(this).serialize(),
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message, 'Success');
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Check if errors exist
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // year error
                            if (errors.year && errors.year[0]) {
                                $("input[name='year']").addClass('is-invalid');
                                $('.year').text(errors.year[0]);
                            }
                            // title error
                            if (errors.title && errors.title[0]) {
                                $("input[name='title']").addClass('is-invalid');
                                $('.title').text(errors.title[0]);
                            }
                            // sub_title error
                            if (errors.sub_title && errors.sub_title[0]) {
                                $("input[name='sub_title']").addClass('is-invalid');
                                $('.sub_title').text(errors.sub_title[0]);
                            }
                            // description error
                            if (errors.description && errors.description[0]) {
                                $("textarea[name='description']").addClass('is-invalid');
                                $('.description').text(errors.description[0]);
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
            });
        });
    </script>
@endpush
