@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@bsMultilangualFormTabs
{{ BsForm::text('name')->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3'])->required()->label(trans('countries::cities.fields.name')) }}
@endBsMultilangualFormTabs

{{ Form::hidden('country_id', $country->id) }}


