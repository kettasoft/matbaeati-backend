@if(auth()->user()->hasPermission('create_countries'))
    <a href="{{ route('dashboard.countries.create', request()->only('type')) }}"
       class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('countries::countries.actions.create')
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('countries::countries.actions.create')
    </button>
@endif
