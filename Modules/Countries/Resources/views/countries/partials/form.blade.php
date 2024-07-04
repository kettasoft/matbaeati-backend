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
{{ BsForm::text('name')->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3'])->required('required')->label(trans('countries::countries.fields.name')) }}
{{ BsForm::text('currency')->required('required')->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3'])->label(trans('countries::countries.fields.currency')) }}
@endBsMultilangualFormTabs
{{ BsForm::text('code')->required()->attribute(['data-parsley-minlength' => '2'])->label(trans('countries::countries.fields.code')) }}
{{ BsForm::text('key')->required()->attribute(['data-parsley-minlength' => '2'])->label(trans('countries::countries.fields.key')) }}
@isset($country)
    {{ BsForm::image('flag')->collection('flags')->files($country->getMediaResource('flags'))->notes(trans('countries::countries.messages.images_note')) }}
@else
    {{ BsForm::image('flag')->collection('flags')->notes(trans('countries::countries.messages.images_note')) }}
@endisset
{{ BsForm::radio('is_default') }}

