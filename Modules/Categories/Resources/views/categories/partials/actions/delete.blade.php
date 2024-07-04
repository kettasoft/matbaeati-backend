@if(auth()->user()->hasPermission('delete_categories'))

    <x-delete-modal :modal="isset($subcategory) ? $subcategory : $category"
                    :title="trans('categories::categories.dialogs.delete.title')"
                    :info="trans('categories::categories.dialogs.delete.info')"
                    :route="route('dashboard.categories.destroy', isset($subcategory) ? $subcategory : $category)"
                    :cancel="trans('categories::categories.dialogs.delete.cancel')"
                    :confirm="trans('categories::categories.dialogs.delete.confirm')"
    ></x-delete-modal>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-danger btn-hover-danger btn-sm">
        <i class="fas fa-trash-alt fa fa-fw"></i>
    </button>
@endcan
