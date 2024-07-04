
    {{ BsForm::resource('countries::cities')->post(route('dashboard.countries.cities.store', $country), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('countries::cities.actions.create'))

        @include('countries::cities.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('countries::cities.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}


