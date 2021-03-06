<!-- property listing -->
@if (!preg_match('/^(chat|message)$/', Request::route()->getName()))
<a href="/property/{{ $property->id }}" class="property-link">
@endif
    <div class="row">
        <div
        @if (preg_match('/^(chat|message)$/', Request::route()->getName()))
             class="chat-property"
        @else
             class="list-property"
        @endif
         >
            <div class="col-md-3 list-image-area">
                <img src="{{ asset('img/' . $property->propertyImage->first()->image_filename) }}" class="list-propertyimage" alt="house" />
            </div>
            <div class="col-md-9">
                <h4>{{ $property->title }}</h4>

                {{-- short property description for search listings (n.b. preformatted html, so verbatim) --}}
                {!! $property->short_description !!}

                <p><h4 class="list-price">{{ $property->priceFormat->display_text }}: &pound;{{ number_format($property->price) }}</h4></p>
            </div>
        </div>
    </div>
@if (!preg_match('/^(chat|message)$/', Request::route()->getName()))
</a>
@endif
