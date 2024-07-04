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
{{ BsForm::text('name')->required()->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3'])->label(trans('categories::categories.fields.name')) }}
{{ BsForm::textarea('description')->rows(3)->attribute('class','form-control textarea')->attribute(['data-parsley-minlength' => '3']) }}
@endBsMultilangualFormTabs

<select2 name="parent_id"
    label="@lang('categories::categories.singular')"
    remote-url="{{ route('categories.select') }}"
    @isset($category)
    value="{{ $category->parent->id ?? old('parent_id') }}"
    @endisset
    :required="false"
></select2>

{{ BsForm::checkbox('active')->value(1)->checked($category->active ?? 0)->label(trans('categories::categories.attributes.active'))->required() }}

@isset($category)
    {{ BsForm::image('image')->collection('default')->files($category->getMediaResource('default'))->notes(trans('categories::categories.messages.images_note')) }}
@else
    {{ BsForm::image('image')->collection('default')->notes(trans('categories::categories.messages.images_note')) }}
@endisset
