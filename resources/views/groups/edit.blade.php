@extends('layouts.master')

@section('title', 'Редактирай група')
@section('page-title', 'Редактирай група')

@section('content')
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Информация за групата
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 offset-2">

                <!--begin::Form-->
                <form class="kt-form" method="POST" action="{{ route('groups.update', $group->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="kt-portlet__body">
                        @if($errors->any())
                            <div class="form-group form-group-last">
                                <div class="alert alert-danger" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning kt-font-white"></i></div>
                                    <div class="alert-text">
                                        Възникнаха грешки
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Име</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $group->name }}">
                            @error('name') <span class="form-text text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <div id="contacts_list">

                            </div>
                            <label>Контакти</label>
                            <select class="kt-dual-listbox" multiple>
                                @foreach($contacts as $contact)
                                    <option value="{{ $contact->id }}"{{ in_array($contact->id, old('contacts') ? old('contacts') : $group->contacts->pluck('id')->toArray()) ? ' selected' : '' }}>{{ $contact->fullName() }}</option>
                                @endforeach
                            </select>
                            @error('contacts') <span class="form-text text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions text-right">
                            <button type="submit" class="btn btn-primary">Редактирай</button>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/pages/components/extended/dual-listbox.js') }}"></script>
@endpush
