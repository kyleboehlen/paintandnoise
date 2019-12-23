@extends('layouts.semantic')

@section('body')
<div class="card">
    <br/><br/>
    <div class="card-header">P&N Categories</div><br/><br/>

    <div class="card-body">
        <form method="POST" action="{{ route('account.categories.update') }}">
            @csrf

                @if($parent_id === false)
                    <label>What art do you vibe with?</label><br/>
                @else
                    <label>What type of {{ App\Models\Categories\Categories::find($parent_id)->name }} do you like?</label>
                    <input type="hidden" name="parent_id" value="{{ $parent_id }}" />
                @endif

                <div class="checkbox-list">
                    @foreach($categories as $category)
                        <label>
                            <input id="checkbox-input-{{ $category->id }}" type="checkbox" class="@if($errors->any()) is-invalid @endif" name="categories[]" value="{{ $category->id }}"
                                @if(in_array($category->id, $user_categories))
                                    checked
                                @endif
                            />
                            <span id="checkbox-span-{{ $category->id }}" class="{{ $category->color }}-hover">
                                <span class="checkbox-span @if(in_array($category->id, $user_categories)) checked @endif">{{ $category->name }}</span>
                            </span>
                        </label>
                        <br/>
                    @endforeach
                </div>
                <br/>


                @if($errors->any())
                    <span class="invalid-feedback" role="alert">
                        @foreach($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </span>
                    <br/><br/>
                @endif

                <input id="categories-submit" type="submit" value="Submit" /><br/><br/><br/><br/>

                @if(is_null($next_parent_category))
                    <a href="{{ route('account') }}">Skip.</a><br/><br/><br/>
                @else
                    <a href="{{ route('account.subcategories', $next_parent_category->id) }}">Skip.</a><br/><br/><br/>
                    <input type="hidden" name="next-parent-category" value="{{ $next_parent_category->id }}" />
                @endif
        </form>
    </div>
</div>
@endsection