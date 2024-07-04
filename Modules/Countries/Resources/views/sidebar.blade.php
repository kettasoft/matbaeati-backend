@component(layout('dashboard').'components.sidebarItem')
@slot('can', ['permission' => 'read_countries'])
@slot('url', route('dashboard.countries.index'))
@slot('name', trans('countries::countries.plural'))
@slot('isActive', request()->routeIs('*countries*'))
@slot('icon', 'fas fa-globe-asia')
@slot('tree', [
    [
        'name' => trans('countries::countries.actions.list'),
        'url' => route('dashboard.countries.index'),
        'can' => ['permission' => 'read_countries'],
        'isActive' => request()->routeIs('*countries.index'),
        'module' => 'Countries',
    ],
    [
        'name' => trans('countries::countries.actions.create'),
        'url' => route('dashboard.countries.create'),
        'can' => ['permission' => 'create_countries'],
        'isActive' => request()->routeIs('*countries.create'),
        'module' => 'Countries',
    ],


])
@endcomponent
