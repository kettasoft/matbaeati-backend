<x-layout :title="trans('categories::categories.actions.create')" :breadcrumbs="['dashboard.categories.create']">

    {{ BsForm::resource('categories::categories')->post(route('dashboard.categories.store'), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('categories::categories.actions.create'))

        @include('categories::categories.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('categories::categories.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
