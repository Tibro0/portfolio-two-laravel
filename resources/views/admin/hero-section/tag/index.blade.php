@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | All Tags
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
                    <div class="breadcrumb-title border-0 pe-3">All Tags</div>
                    {{-- <div class="ms-auto">
                        <a href="{{ route('admin.animation-text.create') }}" class="btn btn-primary px-5">Create New</a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tags as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><i class="{{ $item->icon }} h1"></i></td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-id="{{ $item->id }}"><i
                                                class="lni lni-pencil-alt"></i></button>
                                        {{-- <a href="{{ route('admin.tag.destroy', $item->id) }}" id="delete"
                                            class="btn btn-danger"><i class="lni lni-trash"></i></a> --}}
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

@push('model')
    <!-- Update Tag Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editModalForm">
                        <input type="hidden" name="id">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Preview</label><br>
                                <i class="h1"></i>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Icon <span class="text-danger">*</span> (<a
                                        href="https://icons.getbootstrap.com/"
                                        target="_blank">https://icons.getbootstrap.com/</a>)</label>
                                <input type="text" name="icon" class="form-control" placeholder="Icon">
                                <div class="invalid-feedback icon"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                                <div class="invalid-feedback name"></div>
                            </div>
                            <div class="col-md-12">
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
            $('body').on('click', '#delete', function(e) {
                e.preventDefault();

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
                    url: '{{ route('admin.tag.edit', ':id') }}'.replace(":id", id),
                    type: 'GET',
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            $("input[name='id']").val(data.tag.id);
                            $('#editModalForm').find('i').removeClass().addClass(
                                `${data.tag.icon} h1`);
                            $("input[name='icon']").val(data.tag.icon);
                            $("input[name='name']").val(data.tag.name);
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
                    url: '{{ route('admin.tag.update', ':id') }}'.replace(":id", $(
                        "input[name='id']").val()),
                    type: 'PUT',
                    data: $(this).serialize(),
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#editModalForm').find('i').removeClass().addClass(
                                `${data.tag.icon} h1`);
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
                            // icon error
                            if (errors.icon && errors.icon[0]) {
                                $("input[name='icon']").addClass('is-invalid');
                                $('.icon').text(errors.icon[0]);
                            }
                            // name error
                            if (errors.name && errors.name[0]) {
                                $("input[name='name']").addClass('is-invalid');
                                $('.name').text(errors.name[0]);
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
