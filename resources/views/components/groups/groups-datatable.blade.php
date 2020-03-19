<!--begin: Datatable -->
<table class="kt-datatable" id="{{ $id }}" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Име</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($groups as $group)
        <tr id="group-{{ $group->id }}">
            <td>{{ $group->id }}</td>
            <td>{{ $group->name }}</td>
            <td>
                <div class="dropdown">
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                        <i class="flaticon-more-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__item">
                                <a href="{{ route('groups.edit', $group->id) }}" class="kt-nav__link">
                                    <i class="kt-nav__link-icon la la-edit"></i>
                                    <span class="kt-nav__link-text">Редактирай</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link delete-resource" data-delete-route="{{ route('groups.destroy', $group->id) }}" data-row-id="group-{{ $group->id }}">
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

<!--end: Datatable -->

@push('scripts')
    @component('components.sweet-alert.delete')
    @endcomponent

    <script type="text/javascript">
        $(document).ready(function() {
            var datatable = $('#{{ $id }}').KTDatatable({
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
                    {
                        field: 'Действия',
                        sortable: false
                    }
                ]
            });

            // get ids of checked items
            datatable.on(
                'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
                function(e) {
                    var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
                    var count = checkedNodes.length;
                    $('#kt_datatable_selected_number').html(count)

                    if (count > 0) {
                        $('#kt_datatable_group_action_form').collapse('show');
                    } else {
                        $('#kt_datatable_group_action_form').collapse('hide');
                    }
                }
            );

            function fill_ids (list_id) {
                // Get the ids of the selected documents
                var ids = datatable.rows('.kt-datatable__row--active').
                nodes().
                find('.kt-checkbox--single > [type="checkbox"]').
                map(function(i, chk) {
                    return $(chk).val();
                });

                var ids_html = '';

                ids.each(function(id) {
                    ids_html += '<input name="groups[]" type="hidden" value="' + this + '">';
                })

                return $(list_id).html(ids_html)
            }

            $('.group-action-button').on('click', function(e) {
                var form_id = $(this).data('form-id')
                var list_id = $(this).data('list-id')

                if ($(this).data('alert')) {
                    var swal_object = {
                        title: 'Сигурни ли сте ?',
                        text: "Това действие ще изтрие избраните групи !",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Да, изтрий!',
                        cancelButtonText: 'Отказ'
                    }

                    if ($(this).data('warning') == 'delete') {
                        swal_object = {
                            title: 'Сигурни ли сте ?',
                            text: "Това действие ще изтрие избраните групи !",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Да, изтрий!',
                            cancelButtonText: 'Отказ',
                            reverseButtons:true
                        }
                    }

                    var button = $(this)

                    swal.fire(swal_object).then(function(result) {
                        if (result.value) {
                            if (button.data('loading')) {
                                button.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light')
                                button.prop('disabled', true)
                            }

                            fill_ids(list_id).promise().done(function() {
                                $(form_id).submit()
                            })
                        }
                    });
                } else {
                    if (form_id) {
                        fill_ids(list_id).promise().done(function() {
                            $(form_id).submit()
                        })
                    } else {
                        fill_ids(list_id)
                    }
                }
            });
        });
    </script>
@endpush
