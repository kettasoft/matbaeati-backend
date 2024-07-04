@if(auth()->user()->hasPermission('delete_countries'))
    <x-delete-modal :modal="$country"
                    :title="trans('countries::countries.dialogs.delete.title')"
                    :info="trans('countries::countries.dialogs.delete.info')"
                    :route="route('dashboard.countries.destroy', $country)"
                    :cancel="trans('countries::countries.dialogs.delete.cancel')"
                    :confirm="trans('countries::countries.dialogs.delete.confirm')"
    ></x-delete-modal>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-danger btn-hover-danger btn-sm">
        <i class="fas fa-trash-alt fa fa-fw"></i>
    </button>
@endcan
