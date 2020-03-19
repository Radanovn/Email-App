@extends('layouts.master')

@section('title', 'Създай кампания')
@section('page-title', 'Създай кампания')

@section('styles')
    <link href="{{ asset('assets/css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit" id="app">
                <div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
                    <div class="kt-grid__item">

                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v1__nav">

                            <!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                            <div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon-settings"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            1. Основни данни
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon2-browser-2"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            2. Избери макет
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon-list"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            3. Попълни данни
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon-network"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            4. Избери получатели
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <i class="flaticon2-send-1"></i>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            5. Прегледай и изпрати
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Nav -->
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">

                        <!--begin: Form Wizard Form-->
                        <form method="POST" action="{{ route('campaigns.store') }}" class="kt-form" id="kt_form" enctype="multipart/form-data" data-redirect="{{ route('campaigns.index') }}">
                            @csrf

                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">Основни данни за имейла</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="form-group">
                                            <label>Име</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" v-model="name">
                                            @error('name') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                            <span class="form-text text-danger">Показва се само в приложението, за да го различавате</span>
                                        </div>
                                        <div class="form-group">
                                            <label>От</label>
                                            <input type="text" class="form-control @error('from') is-invalid @enderror" name="from" v-model="from">
                                            @error('from') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                            <span class="form-text text-danger">Имейлът, от който ще бъде изпращано съобщението</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Относно</label>
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" v-model="subject">
                                            @error('subject') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Wizard Step 2-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Изберете макета, който искате</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="form-group">
                                            <label>Макет</label>
                                            <select name="template" id="template" class="form-control" v-model="template">
                                                @foreach($templates as $template)
                                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('template') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 2-->

                            <!--begin: Form Wizard Step 3-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Попълнете данните</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="form-group">
                                            <label>Заглавие</label>
                                            <input type="text" class="form-control" name="title" v-model="title">
                                            @error('title') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Текст</label>
                                            <textarea name="text" id="text" class="form-control wysiwyg" rows="10" v-model="text"></textarea>
                                            @error('text') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <h5 class="kt-section__title kt-section__title-sm">Бутон:</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Текст</label>
                                                    <input type="text" class="form-control" name="button_text" v-model="button_text">
                                                    @error('button_text') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Цвят</label>
                                                    <input type="color" class="form-control" name="button_color" v-model="button_color">
                                                    @error('button_color') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Лого</label>
                                            <input type="file" class="form-control" accept="png, jpg, jpeg, svg, gif" name="logo">
                                            @error('logo') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 3-->

                            <!--begin: Form Wizard Step 4-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Избери получатели</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="form-group">
                                            <label for="group">Избери контакти от група</label>
                                            <select id="group" class="form-control" style="width: 100%; margin-bottom: 20px;" v-model="selected_group">
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-primary" @click="importContacts()">Избери контакти</button>
                                        </div>

                                        <div class="dual-listbox contacts">
                                            <input class="dual-listbox__search" placeholder="Търси" v-model="search">
                                            <div class="dual-listbox__container">
                                                <div>
                                                    <div class="dual-listbox__title">Контакти</div>
                                                    <ul class="dual-listbox__available">
                                                        <li v-for="contact in available_contacts" class="dual-listbox__item" @click="addContact(contact)">@{{ contact.first_name + ' ' + contact.last_name + ' - ' + contact.email }}</li>
                                                    </ul>
                                                </div>
                                                <div class="dual-listbox__buttons">
                                                    <button class="dual-listbox__button" @click="addAll()">Добави всички</button>
                                                    <button class="dual-listbox__button" @click="removeAll()">Премахни всички</button>
                                                </div>
                                                <div>
                                                    <div class="dual-listbox__title">Избрани контакти</div>
                                                    <ul class="dual-listbox__selected">
                                                        <li v-for="contact in selected_contacts" class="dual-listbox__item" @click="removeContact(contact)">@{{ contact.first_name + ' ' + contact.last_name + ' - ' + contact.email }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 4-->

                            <!--begin: Form Wizard Step 5-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Прегледай и изпрати</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__review">
                                        <div class="kt-wizard-v1__review-item">
                                            <div class="kt-wizard-v1__review-title">
                                                Основни данни
                                            </div>
                                            <div class="kt-wizard-v1__review-content">
                                                Име: @{{ name }}<br />
                                                От: @{{ from }}<br />
                                                Относно: @{{ subject }}
                                            </div>
                                        </div>
                                        <div class="kt-wizard-v1__review-item">
                                            <div class="kt-wizard-v1__review-title">
                                                Макет
                                            </div>
                                            <div class="kt-wizard-v1__review-content">
                                                @{{ template }}
                                            </div>
                                        </div>
                                        <div class="kt-wizard-v1__review-item">
                                            <div class="kt-wizard-v1__review-title">
                                                Данни
                                            </div>
                                            <div class="kt-wizard-v1__review-content">
                                                Заглавие: @{{ title }}<br />
                                                {{--Текст: @{{ text }}<br />--}}
                                                Текст на бутон: @{{ button_text }}<br />
                                                Цвят на бутон: @{{ button_color }}<br />
                                            </div>
                                        </div>
                                        <div class="kt-wizard-v1__review-item">
                                            <div class="kt-wizard-v1__review-title">
                                                Получатели
                                            </div>
                                            <div class="kt-wizard-v1__review-content">
                                                <ul style="list-style-type: none;">
                                                    <li v-for="contact in selected_contacts">@{{ contact.first_name + ' ' + contact.last_name + ' ' + contact.email }}</li>
                                                </ul>

                                                <div style="display: none;">
                                                    <input v-for="contact in selected_contacts" type="hidden" name="contacts[]" :value="contact.id">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 5-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">
                                <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                    Назад
                                </button>
                                <button type="submit" class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                    Изпрати
                                </button>
                                <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                    Напред
                                </button>
                            </div>

                            <!--end: Form Actions -->
                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    @include('partials.wysiwyg-script')

    <script src="{{ asset('assets/js/pages/custom/wizard/wizard-1.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>

    <script src="{{ asset('js/vue.js') }}"></script>

    <script type="text/javascript">
        let app = new Vue({
            el: '#app',
            data: {
                selected_group: null,
                group_contacts: [],
                contacts: @json($contacts),
                selected_contacts: [],
                search: '',

                name: '{{ old('name') }}',
                from: '{{ old('from') }}',
                subject: '{{ old('subject') }}',
                template: '{{ old('template') ?? $templates->first()->id }}',
                title: '{{ old('title') }}',
                text: '{{ old('text') }}',
                button_text: '{{ old('button_text') }}',
                button_color: '{{ old('button_color') ?? '#000000' }}'
            },
            computed: {
                available_contacts: function() {
                    let search = this.search

                    let contacts = _.filter(this.contacts, function(contact) {
                        return contact.first_name.includes(search) || contact.last_name.includes(search) || contact.email.includes(search)
                    })

                    return _.difference(contacts, this.selected_contacts)
                }
            },
            watch: {
                selected_group: function(newv, oldv) {
                    this.getGroup()
                }
            },
            methods: {
                getGroup: function() {
                    axios.get('{{ url('/') }}/groups/' + this.selected_group + '/contacts')
                        .then(response => {
                            this.group_contacts = response.data
                        })
                        .catch(err => {
                            console.log(err)
                        })
                },
                addContact: function(contact) {
                    this.selected_contacts.push(contact)
                },
                removeContact: function(contact) {
                    let index = _.indexOf(this.selected_contacts, contact)

                    this.selected_contacts.splice(index, 1)
                },
                addAll: function() {
                    this.selected_contacts = this.contacts
                },
                removeAll: function() {
                    this.selected_contacts = []
                },
                importContacts: function() {
                    let app = this

                    _.each(this.group_contacts, function(contact) {
                        if (_.indexOf(app.selected_contacts, contact) == -1) {
                            app.selected_contacts.push(contact)
                        }
                    })
                }
            }
        })
    </script>
@endpush
