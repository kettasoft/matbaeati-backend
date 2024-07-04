<x-layout :title="$city->name"
    :breadcrumbs=" ['dashboard.countries.cities.edit', $country, $city]">

{{ BsForm::resource('countries::cities')->putModel($city, route('dashboard.countries.cities.update',[$country, $city]), ['files' => true,'data-parsley-validate']) }}
@component(layout('dashboard').'components.box')
  @slot('title', trans('countries::cities.actions.edit'))

  @include('countries::cities.partials.form')

  @slot('footer')
      {{ BsForm::submit()->label(trans('countries::cities.actions.save')) }}
  @endslot
@endcomponent
{{ BsForm::close() }}

</x-layout>
