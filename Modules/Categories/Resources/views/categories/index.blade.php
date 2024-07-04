<x-layout :title="trans('categories::categories.plural')" :breadcrumbs="['dashboard.categories.index']">

    @include('categories::categories.partials.filter')

    @component(layout('dashboard').'components.table-box')
        @slot('title', trans('categories::categories.actions.list'))
        @slot('tools')
            @include('categories::categories.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('categories::categories.attributes.name')</th>
            <th>@lang('categories::categories.attributes.status')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>
                    <a href="{{ route('dashboard.categories.show', $category) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ Illuminate\Support\Str::limit($category->name, $limit = 50, $end = '...') }}
                    </a>
                </td>

                <td>
                    @if ($category->isActive())
                        <i class="fas fa-check fa-lg text-success"></i>
                        @else
                        <i class="fas fa-times fa-lg text-danger"></i>
                    @endif
                </td>

                <td style="width: 160px">
                    @include('categories::categories.partials.actions.show')
                    @include('categories::categories.partials.actions.edit')
                    @include('categories::categories.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('categories::categories.empty')</td>
            </tr>
        @endforelse
        </tbody>

        @if($categories->hasPages())
            @slot('footer')
                {{ $categories->links() }}
            @endslot
        @endif
    @endcomponent

</x-layout>


