@if(auth()->user()->hasPermission('update_roles'))
    <a href="{{ route('dashboard.roles.edit', $role) }}"
       class="btn btn-outline-primary  btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-primary  btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </button>
@endcan
