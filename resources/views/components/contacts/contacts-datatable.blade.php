<!--begin: Datatable -->
<table class="kt-datatable" id="{{ $id }}" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Име</th>
        <th>Email</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr id="contact-{{ $contact->id }}">
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->fullName() }}</td>
            <td>{{ $contact->email }}</td>
            <td>
                <div class="dropdown">
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                        <i class="flaticon-more-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__item">
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="kt-nav__link">
                                    <i class="kt-nav__link-icon la la-edit"></i>
                                    <span class="kt-nav__link-text">Редактирай</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link delete-resource" data-delete-route="{{ route('contacts.destroy', $contact->id) }}" data-row-id="contact-{{ $contact->id }}">
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
                    ids_html += '<input name="contacts[]" type="hidden" value="' + this + '">';
                })

                return $(list_id).html(ids_html)
            }

            $('.contact-action-button').on('click', function(e) {
                var form_id = $(this).data('form-id')
                var list_id = $(this).data('list-id')
                var list_class = $(this).data('list-class')

                if ($(this).data('alert')) {
                    var swal_object = {
                        title: 'Сигурни ли сте ?',
                        text: "Това действие ще изтрие избраните контакти !",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Да, изтрий!',
                        cancelButtonText: 'Отказ',
                        reverseButtons:true
                    }

                    if ($(this).data('warning') == 'delete') {
                        swal_object = {
                            title: 'Сигурни ли сте ?',
                            text: "Това действие ще изтрие избраните контакти !",
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
                            fill_ids(list_class).promise().done(function() {
                                $(form_id).submit()
                            })
                        }
                    });
                } else {
                    if (form_id) {
                        fill_ids(list_id).promise().done(function() {
                            $(form_id).submit()
                        })
                        fill_ids(list_class).promise().done(function() {
                            $(form_id).submit()
                        })
                    } else {
                        fill_ids(list_id)
                        fill_ids(list_class)
                    }
                }
            });
        });
    </script>
@endpush
