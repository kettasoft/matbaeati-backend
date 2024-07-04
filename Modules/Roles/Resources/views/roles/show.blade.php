<x-layout :title="$role->name" :breadcrumbs="['dashboard.roles.show', $role]">

    <div class="row">
        <div class="col-md-6">
            @component(layout('dashboard').'components.box')
                @slot('bodyClass', 'p-0')

                <table class="table table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('roles::roles.attributes.name')</th>
                        <td>{{ $role->display_name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('roles::roles.attributes.description')</th>
                        <td>{{ $role->description }}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('roles::roles.partials.actions.edit')
                    @include('roles::roles.partials.actions.delete')
                @endslot
            @endcomponent

        </div>
    </div>

</x-layout>
