<x-layout :title="$country->name"
    :breadcrumbs=" ['dashboard.countries.edit', $country]">

{{ BsForm::resource('countries::countries')->putModel($country, route('dashboard.countries.update', $country), ['files' => true,'data-parsley-validate']) }}
@component(layout('dashboard').'components.box')
  @slot('title', trans('countries::countries.actions.edit'))

  @include('countries::countries.partials.form')

  @slot('footer')
      {{ BsForm::submit()->label(trans('countries::countries.actions.save')) }}
  @endslot
@endcomponent
{{ BsForm::close() }}

</x-layout>
