<!--begin: Selected Rows Group Action Form -->
<div class="kt-form kt-form--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form">
    <div class="row align-items-center">
        <div class="col-xl-12">
            <div class="kt-form__group kt-form__group--inline">
                <div class="kt-form__label kt-form__label-no-wrap">
                    <label class="kt-font-bold kt-font-danger-">Selected
                        <span id="kt_datatable_selected_number">0</span> contacts:</label>
                </div>
                <div class="kt-form__control" id="controls">
                    <div class="btn-toolbar">
                        @if(in_array('delete', $options))
                            <button
                                class="btn btn-sm btn-danger contact-action-button"
                                type="button"
                                data-form-id="#contacts_delete_form"
                                data-list-id="#contacts_delete_list"
                                data-warning="delete"
                                data-loading="1"
                                data-alert="1">Изтрий</button>
                            <form action="{{ route('contacts.delete-multiple') }}" method="POST" style="display: none;" id="contacts_delete_form">
                                @csrf
                                @method('DELETE')

                                <div id="contacts_delete_list">

                                </div>
                            </form>
                            &nbsp;&nbsp;&nbsp;
                        @endif

                        @if(in_array('group', $options))
                            <button
                                type="button"
                                class="btn btn-sm btn-success contact-action-button"
                                data-toggle="modal"
                                data-target="#group_modal"
                                data-list-class=".group_list">Добави към група</button>

                        &nbsp;&nbsp;&nbsp; <!--begin::Modal-->
                            <div class="modal fade" id="group_modal" tabindex="-1" role="dialog" aria-labelledby="addToGroup" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addToGroup">Добави към група</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @if($groups->count())
                                                <form method="POST" action="{{ route('groups.add-contacts') }}" id="group_form">
                                                    @csrf

                                                    <div class="group_list">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="group">Добави към група</label>
                                                        <br>
                                                        <select name="group" id="group" class="form-control select2" style="width: 100%;">
                                                            @foreach($groups as $group)
                                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            @if($groups->count())
                                                <button
                                                    type="button"
                                                    class="btn btn-success"
                                                    onclick="event.preventDefault(); document.getElementById('group_form').submit();">Add to group</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addToGroup">Или създай нова</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('groups.store') }}" id="create_group_form">
                                                @csrf
                                                <div class="group_list">

                                                </div>
                                                <div class="form-group">
                                                    <label for="create-group">Име</label>
                                                    <input type="text" class="form-control" id="create-group" name="name" value="{{ old('name') }}">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                onclick="event.preventDefault(); document.getElementById('create_group_form').submit();">Създай и добави</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end::Modal-->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end: Selected Rows Group Action Form -->
