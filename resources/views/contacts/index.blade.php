@extends('layouts.master')

@section('title', 'Контакти')
@section('page-title', 'Контакти')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">

            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('contacts.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Нов контакт
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="dropzone dropzone-default p-0" id="kt_dropzone_1">
                <div class="dropzone-msg dz-message needsclick">
                    <h3 class="dropzone-msg-title">Пуснете CSV файл тук или кликнете за да качите.</h3>
                    <span class="dropzone-msg-desc">Структурата е: {first_name},{last_name},{email}</span>
                </div>
            </div>

            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="Търси..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end: Search Form -->

            @component('components.contacts.contacts-controls', ['options' => ['delete', 'group'], 'groups' => $groups])
            @endcomponent
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            @component('components.contacts.contacts-datatable', ['id' => 'contacts-table', 'contacts' => $contacts])
            @endcomponent
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();

            // single file upload
            $('#kt_dropzone_1').dropzone({
                url: "{{ route('contacts.import') }}", // Set the url for your upload script location
                headers: {
                  "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 5, // MB
                addRemoveLinks: true
            });
        });
    </script>
@endpush
