<x-layout :title="$city->name" :breadcrumbs="['dashboard.countries.show',$country]">

    <div class="row">
        <div class="col-md-6">
            @component(layout('dashboard').'components.box')
                @slot('bodyClass', 'p-0')

                <table class="table table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('countries::cities.attributes.name')</th>
                        <td>{{ $city->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('countries::countries.attributes.name')</th>
                        <td>{{ $city->country->name }}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('countries::cities.partials.actions.edit')
                    @include('countries::cities.partials.actions.delete')
                @endslot
            @endcomponent
    </div>

</div>

</x-layout>


