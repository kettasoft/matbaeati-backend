
@include('countries::cities.partials.filter')

@component(layout('dashboard').'components.table-box')
    @slot('title', trans('countries::cities.actions.list'))
    <thead>
    <tr>
        <th>@lang('countries::cities.attributes.name')</th>

        <th style="width: 160px">...</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cities as $city)
        <tr>
            <td>{{ $city->name }}</td>


            <td style="width: 160px">
                @include('countries::cities.partials.actions.show')
                @include('countries::cities.partials.actions.edit')
                @include('countries::cities.partials.actions.delete')
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('countries::cities.empty')</td>
        </tr>
    @endforelse

    @if($cities->hasPages())
        @slot('footer')
            {{ $cities->links() }}
        @endslot
    @endif
@endcomponent
