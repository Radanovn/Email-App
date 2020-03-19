@extends('layouts.master')

@section('title', 'Редактирай контакт')
@section('page-title', 'Редактирай контакт')

@section('content')
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="row">
                    <div class="col-md-6 offset-3">
                <!--begin::Form-->
                <form class="kt-form" method="POST" action="{{ route('contacts.update', $contact->id) }}">
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
                            <label for="first_name">Име</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') ?? $contact->first_name }}">
                            @error('first_name') <span class="form-text text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') ?? $contact->last_name }}">
                            @error('last_name') <span class="form-text text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Имейл адрес</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') ?? $contact->email }}">
                            @error('email') <span class="form-text text-danger">{{ $message }}</span> @enderror
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
