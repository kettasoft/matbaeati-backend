<x-layout :title="Illuminate\Support\Str::limit($category->name, $limit = 50, $end = '...')"
    :breadcrumbs=" ['dashboard.categories.edit', $category]">

{{ BsForm::resource('categories::categories')->putModel($category, route('dashboard.categories.update', $category), ['files' => true,'data-parsley-validate']) }}
@component(layout('dashboard').'components.box')
  @slot('title', trans('categories::categories.actions.edit'))

  @include('categories::categories.partials.form')

  @slot('footer')
      {{ BsForm::submit()->label(trans('categories::categories.actions.save')) }}
  @endslot
@endcomponent
{{ BsForm::close() }}

</x-layout>
