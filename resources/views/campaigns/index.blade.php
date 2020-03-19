@extends('layouts.master')

@section('title', 'Кампании')
@section('page-title', 'Кампании')

@section('content')
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">

                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('campaigns.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Нова кампания
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
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
                               {{-- <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Статус:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_status">
                                                <option value="">Всички</option>
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Search Form -->

                {{--@component('components.contacts.contacts-controls', ['options' => ['delete']])
                @endcomponent--}}
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <table class="kt-datatable" id="campaigns-table" width="100%">
                    <thead>
                        <tr>
                            <th>Име</th>
                            <th>От</th>
                            <th>Относно</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaigns as $campaign)
                            <tr id="campaign-{{ $campaign->id }}">
                                <td>{{ $campaign->name }}</td>
                                <td>{{ $campaign->from }}</td>
                                <td>{{ $campaign->subject }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                                            <i class="flaticon-more-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                    <a href="{{ route('campaigns.edit', $campaign->id) }}" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon la la-edit"></i>
                                                        <span class="kt-nav__link-text">Редактирай</span>
                                                    </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link delete-resource" data-delete-route="{{ route('campaigns.destroy', $campaign->id) }}" data-row-id="campaign-{{ $campaign->id }}">
                                                        <i class="kt-nav__link-icon la la-trash"></i>
                                                        <span class="kt-nav__link-text">Изтрий</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@push('scripts')
    @component('components.sweet-alert.delete')
    @endcomponent

    <script type="text/javascript">
        $(document).ready(function() {

            // single file upload
            var datatable = $('#campaigns-table').KTDatatable({
                rows: {
                    autoHide: false
                },
                search: {
                    input: $('#generalSearch')
                },
                columns: [
                    {
                        field: 'ID',
                        title: '#',
                        sortable: false,
                        width: 20,
                        type: 'number',
                        selector: {class: 'kt-checkbox--solid'},
                        textAlign: 'center'
                    },
                    /*{
                        field: 'Status',
                        title: 'Статус',
                        // callback function support for column rendering
                        template: function(row) {
                            var status = {
                                1: {'title': 'Изпратена', 'class': ' kt-badge--success'},
                                2: {'title': 'Draft', 'class': 'kt-badge--warning'},
                                3: {'title': 'Scheduled', 'class': ' kt-badge--brand'},
                            };
                            return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
                        },
                    },*/
                    {
                        field: 'Действия',
                        sortable: false
                    }
                ]
            });

            $('#kt_form_status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'Статус');
            });

            $('#kt_form_status').selectpicker();
        });
    </script>
@endpush
