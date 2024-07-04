@if(auth()->user()->hasPermission('delete_roles') && $role->name != 'super_admin')
    <x-delete-modal :modal="$role"
                    :title="trans('roles::roles.dialogs.delete.title')"
                    :info="trans('roles::roles.dialogs.delete.info')"
                    :route="route('dashboard.roles.destroy', $role)"
                    :cancel="trans('roles::roles.dialogs.delete.cancel')"
                    :confirm="trans('roles::roles.dialogs.delete.confirm')"
    ></x-delete-modal>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-danger btn-sm">
        <i class="fas fa-trash-alt fa fa-fw"></i>
    </button>
@endcan
