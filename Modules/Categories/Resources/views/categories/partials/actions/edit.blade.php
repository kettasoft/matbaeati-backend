@if(auth()->user()->hasPermission('update_categories'))
    <a href="{{ route('dashboard.categories.edit', isset($subcategory) ? $subcategory : $category) }}"
       class="btn btn-outline-primary btn-hover-primary btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-primary btn-hover-primary btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </button>
@endcan
