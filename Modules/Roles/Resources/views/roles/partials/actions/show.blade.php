@if(auth()->user()->hasPermission('show_roles'))
    <a href="{{ route('dashboard.roles.show', $role) }}"
       class="btn btn-outline-warning  btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-warning  btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </button>
@endcan
