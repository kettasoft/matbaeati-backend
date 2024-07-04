{{ BsForm::resource('countries::countries')->get(url()->current()) }}
@component(layout('dashboard').'components.accordion')
    @slot('title', trans('countries::countries.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('code')->value(request('code')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('key')->value(request('key')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                ->label(trans('countries::countries.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('countries::countries.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
