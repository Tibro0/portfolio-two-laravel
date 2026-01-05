@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | Setting
@endsection

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link list-view {{ Session::has('admin_general_setting_list_style') && Session::get('admin_general_setting_list_style') == 'section_one' ? 'active' : '' }} {{ !Session::has('admin_general_setting_list_style') ? 'active' : '' }}"
                                    data-id="section_one" data-bs-toggle="tab" href="#general-setting" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-cog font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">General Setting</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link list-view {{ Session::has('admin_general_setting_list_style') && Session::get('admin_general_setting_list_style') == 'section_two' ? 'active' : '' }}"
                                    data-id="section_two" data-bs-toggle="tab" href="#email-configuration" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-envelope font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Email Configuration</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            @include('admin.setting.section.general-setting')
                            @include('admin.setting.section.mail-setting')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-link')
    {{-- List Link Active --}}
    <script>
        $(document).ready(function() {
            $('.list-view').on('click', function() {
                let style = $(this).data('id');
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.admin-general-setting-list-style') }}",
                    data: {
                        style: style
                    },
                    success: function(data) {

                    }
                });
            })
        });
    </script>
@endsection
