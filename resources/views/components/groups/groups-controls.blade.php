<!--begin: Selected Rows Group Action Form -->
<div class="kt-form kt-form--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form">
    <div class="row align-items-center">
        <div class="col-xl-12">
            <div class="kt-form__group kt-form__group--inline">
                <div class="kt-form__label kt-form__label-no-wrap">
                    <label class="kt-font-bold kt-font-danger-">Избрани
                        <span id="kt_datatable_selected_number">0</span> групи:</label>
                </div>
                <div class="kt-form__control" id="controls">
                    <div class="btn-toolbar">
                        @if(in_array('delete', $options))
                            <button
                                class="btn btn-sm btn-danger group-action-button"
                                type="button"
                                data-form-id="#groups_delete_form"
                                data-list-id="#groups_delete_list"
                                data-warning="delete"
                                data-loading="1"
                                data-alert="1">Изтрий</button>
                            <form action="{{ route('groups.delete-multiple') }}" method="POST" style="display: none;" id="groups_delete_form">
                                @csrf
                                @method('DELETE')

                                <div id="groups_delete_list">

                                </div>
                            </form>
                            &nbsp;&nbsp;&nbsp;
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end: Selected Rows Group Action Form -->
