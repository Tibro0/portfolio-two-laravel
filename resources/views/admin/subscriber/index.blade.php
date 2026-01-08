@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | All Active Subscribers
@endsection

@section('css-link')
    {{-- dataTables Css --}}
    <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    {{-- Bootstrap-icons Css --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" />
    {{-- summernote Css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title border-0 pe-3">All Active Subscribers (Sent 500 Emails Per Day Free)</div>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-outline-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Main Title Update</button>
                        <button type="button" class="btn btn-outline-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#exampleExtraLargeModal">Send News Letter</button>
                        <a href="{{ route('admin.subscriber.create') }}" class="btn btn-primary px-5">Create
                            New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subscribers as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        <a href="{{ route('admin.subscriber.edit', $item->id) }}" class="btn btn-primary"><i
                                                class="lni lni-pencil-alt"></i></a>
                                        {{-- <a href="{{ route('admin.subscriber.destroy', $item->id) }}" id="delete"
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

@section('model')
    <!-- Modal -->
    <div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send News Letter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.subscriber.sent') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" name="subject"
                                    class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}"
                                    placeholder="Subject">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Message <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <textarea id="summernote" name="message"></textarea>
                                </div>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary px-5">Sent Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Title Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact Title Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.contact.main-title.update') }}" method="POST" id="contact-main-title">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Contact Main Title <span class="text-danger">*</span></label>
                                <input type="text" name="contact_main_title" class="form-control"
                                    value="{{ old('contact_main_title') ?? @$title['contact_main_title'] }}"
                                    placeholder="Contact Main Title">
                                <div class="invalid-feedback contact_main_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Contact Sub Title <span class="text-danger">*</span></label>
                                <input type="text" name="contact_sub_title" class="form-control"
                                    value="{{ old('contact_sub_title') ?? @$title['contact_sub_title'] }}"
                                    placeholder="Contact Sub Title">
                                <div class="invalid-feedback contact_sub_title"></div>
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
    {{-- summernote Js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#contact-main-title').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('input').removeClass('is-invalid');
                // Button Disabled
                let submitBtn = $(this).find('button[type="submit"]');
                let originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Check if errors exist
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // contact_main_title error
                            if (errors.contact_main_title && errors.contact_main_title[0]) {
                                $("input[name='contact_main_title']").addClass('is-invalid');
                                $('.contact_main_title').text(errors.contact_main_title[0]);
                            }
                            // contact_sub_title error
                            if (errors.contact_sub_title && errors.contact_sub_title[0]) {
                                $("input[name='contact_sub_title']").addClass('is-invalid');
                                $('.contact_sub_title').text(errors.contact_sub_title[0]);
                            }
                        }
                        // If no validation errors but general error
                        else if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message);
                        }
                        // Unknown error
                        else {
                            toastr.error('Something Went Wrong. Please Try Again Later.');
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
