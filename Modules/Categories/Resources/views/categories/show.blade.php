<x-layout :title="Illuminate\Support\Str::limit($category->name, $limit = 50, $end = '...')"
    :breadcrumbs="['dashboard.categories.show',$category]">

<div class="row">
    <div class="col-md-6">
        @component(layout('dashboard').'components.box')
            @slot('bodyClass', 'p-0')

            <table class="table table-middle">
                <tbody>
                    {{-- Name --}}
                    <tr>
                        <th width="200">@lang('categories::categories.attributes.name')</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    {{-- Status --}}
                    <tr>
                        <th width="200">@lang('categories::categories.attributes.status')</th>
                        <td>
                        @if ($category->isActive())
                        <i class="fas fa-check fa-lg text-success"></i>
                            @else
                            <i class="fas fa-times fa-lg text-danger"></i>
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <th width="200">@lang('categories::categories.attributes.description')</th>
                        <td>{{ strip_tags($category->description) }}</td>
                    </tr>

                    {{-- Image --}}
                    <tr>
                        <th width="200">@lang('categories::categories.attributes.image')</th>
                        <td>
                            @if($category->getFirstMedia('default'))
                                <file-preview :media="{{ $category->getMediaResource('default') }}"></file-preview>
                            @else
                                <img src="{{ $category->getAvatar() }}"
                                    class="img img-size-64"
                                    alt="{{ $category->name }}">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            @slot('footer')
                @include('categories::categories.partials.actions.edit')
                @include('categories::categories.partials.actions.delete')
            @endslot
        @endcomponent

    </div>
    {{-- ------------------------------------------------------------------------------------ --}}
    @if (!$category->subcategory->isEmpty())
    <div class="col-md-6">
        @component(layout('dashboard').'components.box')
            @slot('bodyClass', 'p-0')
        <h3 style="padding: 0.75rem">@lang('categories::categories.attributes.subcategories') ({{ $category->subcategory->count() }})</h3>
            <table class="table table-middle">
                <tbody>
                    @foreach ($category->subcategory as $subcategory)
                        <tr>
                            <th>{{$subcategory->name}}</th>
                            <td style="text-align: end">
                                @include('categories::categories.partials.actions.show', ['subcategory' => $subcategory])
                                @include('categories::categories.partials.actions.edit', ['subcategory' => $subcategory])
                                @include('categories::categories.partials.actions.delete', ['subcategory' => $subcategory])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endcomponent

    </div>
    @endif
</div>

</x-layout>>
