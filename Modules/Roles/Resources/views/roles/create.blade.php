<x-layout :title="trans('roles::roles.actions.create')" :breadcrumbs="['dashboard.roles.create']">

    {{ BsForm::resource('roles::roles')->post(route('dashboard.roles.store'), ['files' => true]) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('roles::roles.actions.create'))

        @include('roles::roles.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('roles::roles.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
