@component(layout('dashboard').'components.sidebarItem')
    @slot('can', ['permission' => 'read_categories'])
    @slot('url', route('dashboard.categories.index'))
    @slot('name', trans('categories::categories.plural'))
    @slot('isActive', request()->routeIs('*categories*'))
    @slot('icon', 'fas fa-bars')
    @slot('tree', [
        [
            'name' => trans('categories::categories.actions.list'),
            'url' => route('dashboard.categories.index'),
            'can' => ['permission' => 'read_categories'],
            'isActive' => request()->routeIs('*categories.index'),
            'module' => 'Categories',
        ],
        [
            'name' => trans('categories::categories.actions.create'),
            'url' => route('dashboard.categories.create'),
            'can' => ['permission' => 'create_categories'],
            'isActive' => request()->routeIs('*categories.create'),
            'module' => 'Categories',
        ],
    ])
@endcomponent
