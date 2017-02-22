@extends('layouts.app')

@section('content')
<div class="container">
    @if (isset($propertyId) && !empty($propertyId))
        <h1>Add a new property</h1>
    @else
        <h1>Edit a property</h1>
    @endif

    <form method="post" action="/property/add">
        {{ csrf_field() }}
        @if (isset($propertyId) && !empty($propertyId))
            <input type="hidden" name="propertyId" value="{{ $propertyId }}" />
        @endif
        <div class="panel panel-default"><div class="panel-body">
            <div class="form-group">
                <form method="post" action="/content/create">
                    <label for="propertyTitle">Title</label>
                    <input type="text" class="form-control" name="propertyTitle" value="{{ $propertyTitle }}" placeholder="Enter property title here" />

                    <label for="address1">Address Line 1</label>
                    <input type="text" class="form-control" name="address1" value="{{ $address1 }}" placeholder="Address line 1" />

                    <label for="address2">Address Line 2</label>
                    <input type="text" class="form-control" name="address2" value="{{ $address2 }}" placeholder="Address line 2" />

                    <label for="town">Town</label>
                    <input type="text" class="form-control" name="town" value="{{ $town }}" placeholder="Town" />

                    <label for="county">County</label>
                    <input type="text" class="form-control" name="county" value="{{ $county }}" placeholder="County" />

                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" name="postcode" value="{{ $postcode }}" placeholder="Postcode" />

                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" value="{{ $price }}" placeholder="Price (pounds sterling)" />

                    <label for="priceFormat">Price format</label>
                    <select class="form-control" id="priceFormat" name="priceFormat">
                        @foreach ($priceFormats as $optionPriceFormat)
                        <option value="{{ $optionPriceFormat->id }}"{{ $optionPriceFormat->id === $priceFormat ? ' selected' : '' }}>{{ $optionPriceFormat->display_text }}</option>
                        @endforeach
                    </select>

                    <label for="shortDescription">Short description (for search listings)</label>
                    <textarea class="form-control" id="editor-short-description" name="shortDescription">{{ $shortDescription }}</textarea>

                    <label for="description">Description (for full-page property view)</label>
                    <textarea class="form-control" id="editor-description" name="description">{{ $description }}</textarea>

                    <input type="submit" class="btn btn-success" name="save" value="{{ isset($propertyId) && !empty($propertyId) ? 'Update' : 'Save' }}" />
                </form>
            </div>
        </div></div>
    </form>
</div>

<script src="{{ asset('js/simplemde.min.js') }}"></script>
<script>
var shortDescriptionEditor = new SimpleMDE({
    element: $('#editor-short-description')[0]
})
var descriptionEditor = new SimpleMDE({
    element: $('#editor-description')[0]
})
</script>
@endsection
