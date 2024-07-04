<x-layout :title="trans('roles::roles.plural')" :breadcrumbs="['dashboard.roles.index']">

    @include('roles::roles.partials.filter')

    @component(layout('dashboard').'components.table-box')
        @slot('title', trans('roles::roles.actions.list'))
        @slot('tools')
            @include('roles::roles.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('roles::roles.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($roles as $role)
            <tr>
                <td>
                    <a href="{{ route('dashboard.roles.show', $role) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $role->display_name }}
                    </a>
                </td>

                <td style="width: 160px">
                    @include('roles::roles.partials.actions.show')
                    @include('roles::roles.partials.actions.edit')
                    @include('roles::roles.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('roles::roles.empty')</td>
            </tr>
        @endforelse
        </tbody>

        @if($roles->hasPages())
            @slot('footer')
                {{ $roles->links() }}
            @endslot
        @endif
    @endcomponent

</x-layout>
