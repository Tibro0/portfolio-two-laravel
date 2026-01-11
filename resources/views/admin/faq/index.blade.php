@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | All Faq
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
            <div class="card-body">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title border-0 pe-3">All Faq</div>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-outline-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Main Title Update</button>
                        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary px-5">Create New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($faqs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($item->question, 50) }}</td>
                                    <td>{{ Str::limit($item->answer, 100) }}</td>
                                    <td>
                                        <a href="{{ route('admin.faq.edit', $item->id) }}" class="btn btn-primary"><i
                                                class="lni lni-pencil-alt"></i></a>
                                        <a href="{{ route('admin.faq.destroy', $item->id) }}" id="delete"
                                            class="btn btn-danger"><i class="lni lni-trash"></i></a>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FAQ Title Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.faq.main-title.update') }}" method="POST" id="faq-main-title">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">FAQ Main Title <span class="text-danger">*</span></label>
                                <input type="text" name="faq_main_title" class="form-control"
                                    value="{{ old('faq_main_title') ?? @$title['faq_main_title'] }}"
                                    placeholder="FAQ Main Title">
                                <div class="invalid-feedback faq_main_title"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">FAQ Sub Title <span class="text-danger">*</span></label>
                                <input type="text" name="faq_sub_title" class="form-control"
                                    value="{{ old('faq_sub_title') ?? @$title['faq_sub_title'] }}"
                                    placeholder="FAQ Sub Title">
                                <div class="invalid-feedback faq_sub_title"></div>
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
            $('#faq-main-title').on('submit', function(e) {
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
                            // faq_main_title error
                            if (errors.faq_main_title && errors.faq_main_title[0]) {
                                $("input[name='faq_main_title']").addClass('is-invalid');
                                $('.faq_main_title').text(errors.faq_main_title[0]);
                            }
                            // faq_sub_title error
                            if (errors.faq_sub_title && errors.faq_sub_title[0]) {
                                $("input[name='faq_sub_title']").addClass('is-invalid');
                                $('.faq_sub_title').text(errors.faq_sub_title[0]);
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
@endpush
