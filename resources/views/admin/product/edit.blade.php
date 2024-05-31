@extends('layouts.admin.app')
@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>@lang('site.manage_products')</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>@lang('site.add')</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>

                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('put') }}

                            @foreach($languages as $localeCode => $properties)
                                @php
                                    $translation = $product->translations->firstWhere('locale', $localeCode);
                                @endphp
                                <section class="panel">
                                    <header class="panel-heading">
                                        {{ $properties['name'] }}
                                        <span class="tools pull-right">
                                            <a class="icon-chevron-down" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body" style="display: block;">
                                        <div class="form-group">
                                            <label for="title_{{ $localeCode }}">@lang('site.name') ({{ $properties['name'] }})</label>
                                            <input id="title_{{ $localeCode }}" name="name[{{ $localeCode }}]" value="{{ $translation->name ?? '' }}" required type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="panel-body" style="display: block;">
                                        <div class="form-group">
                                            <label for="description_{{ $localeCode }}">@lang('site.description') ({{ $properties['name'] }})</label>
                                            <input id="description_{{ $localeCode }}" name="description[{{ $localeCode }}]" value="{{ $translation->description ?? '' }}" required type="text" class="form-control">
                                        </div>
                                    </div>
                                </section>
                            @endforeach

                            <div class="item form-group">
                                <div class="col-md-5">
                                    <label class="" for="category_id">@lang('site.Category') <span class="required">*</span></label>
                                    <select name="category_id" class="form-control">
                                        <option value="">@lang('site.all_categories')</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="price">@lang('site.price')</label>
                                    <input type="number" name="price" min="0" value="{{ $product->price }}" required class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="quantity">@lang('site.quantity')</label>
                                    <input type="number" min="0" name="quantity" value="{{ $product->quantity }}" required class="form-control">
                                </div>
                            </div>

                            <!-- Display Product Image -->
                            <div class="form-group">
                                <label for="image"></label>
                                @if($product->media->isNotEmpty())
                                    @foreach($product->media as $media)
                                        <img src="{{ $media->original_url }}" style="width: 100px" alt="@lang('site.no_image')" class="img-fluid">
                                    @endforeach
                                @else
                                    <p>@lang('site.no_image')</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">@lang('site.image')</label>
                                <input type="file" name="image" class="form-control image">
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">@lang('site.save')</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
