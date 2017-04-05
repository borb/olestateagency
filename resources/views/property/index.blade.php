@extends('layouts.app')

@section('content')
<div class="container">
    <!-- property listings -->
    <div class="row">
        <div class="col-md-9">
            @if ($totalProperties === 0)
                <div class="row">
                    <p><error>No properties found!</error> Try changing your filters.</p>
                </div>
            @else
                <div class="row">
                    <p>{{ $totalProperties }} {{ str_plural('property', $totalProperties) }} match your filters.
                </div>
            @endif

            <!-- featured property -->
            @include('property.featured')

            <!-- property list -->
            @foreach ($properties as $property)
                @include('property.listing')
            @endforeach
        </div>

        <!-- sidenav -->
        <div class="col-md-3">
            <h4>Filter your results</h4>
            <form method="post" action="/properties">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="minPrice">Minimum price</label>
                    <input type="number" class="form-control" id="minPrice" name="minPrice" value="{{ request('minPrice', $filterData['minPrice']) }}" placeholder="e.g. 100,000"/>
                </div>
                <div class="form-group">
                    <label for="maxPrice">Maximum price</label>
                    <input type="number" class="form-control" id="maxPrice" name="maxPrice" value="{{ request('maxPrice', $filterData['maxPrice']) }}" placeholder="e.g. 500,000"/>
                </div>
                <div class="form-group">
                    <label for="bedrooms">Number of bedrooms</label>
                    <select class="form-control" id="bedrooms" name="bedrooms">
                        @foreach ($bedrooms as $label => $value)
                        <option value="{{ $value }}"{{ $value === request('bedrooms', $filterData['bedrooms']) ? ' selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <input type="text" class="form-control" id="keywords" name="keywords" value="{{ request('keywords', join(' ', $filterData['keywords'])) }}" placeholder="e.g. garage, conservatory"/>
                </div>
                <button type="submit" class="btn btn-default">Update results</button>
                <input type="reset" class="btn" value="Reset"/>
            </form>

            <p></p>

            @if (Auth::check())
                <form method="post" action="/properties/savesearch">
                    {{ csrf_field() }}
                    <input type="hidden" name="filters" value="{{ $filters }}" />
                    <div class="form-group">
                        <label for="searchname">Save this search</label>
                        <input type="text" class="form-control" id="searchName" name="searchName" value="{{ request('searchName') }}" placeholder="e.g. three beds" />
                    </div>
                    <button type="submit" class="btn btn-default">Save search</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
