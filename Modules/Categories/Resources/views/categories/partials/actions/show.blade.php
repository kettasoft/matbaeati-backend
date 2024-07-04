@if(auth()->user()->hasPermission('show_categories'))
    <a href="{{ route('dashboard.categories.show', isset($subcategory) ? $subcategory : $category) }}"
       class="btn btn-outline-warning btn-hover-warning btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-warning btn-hover-warning btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </button>
@endcan
