@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | Setting
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-cog font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">General Setting</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-envelope font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Email Configuration</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bx bx-microphone font-18 me-1"></i>
                                        </div>
                                        <div class="tab-title">Contact</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">

                            @include('admin.setting.section.general-setting')
                            @include('admin.setting.section.mail-setting')
                            <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's
                                    organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify
                                    pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy
                                    hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred
                                    pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie
                                    etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl
                                    craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
