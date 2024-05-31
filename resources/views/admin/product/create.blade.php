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

                        {{-- Show validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            @foreach($languages as $localeCode => $properties)
                                <div class="item form-group">
                                    <div class="col-md-5">
                                        <div class="panel-body" style="display: block;">
                                            <div class="form-group">
                                                <label for="title_{{ $localeCode }}">@lang('site.name') ({{ $properties['name'] }})</label>
                                                <input id="title_{{ $localeCode }}" name="name[{{ $localeCode }}]" value="{{ old('name.'.$localeCode) }}" required type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="panel-body" style="display: block;">
                                            <div class="form-group">
                                                <label for="description_{{ $localeCode }}">@lang('site.description') ({{ $properties['name'] }})</label>
                                                <input id="description_{{ $localeCode }}" name="description[{{ $localeCode }}]" value="{{ old('description.'.$localeCode) }}" required type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="item form-group">
                                <div class="col-md-5">
                                    <label class="" for="category_id">@lang('site.Category') <span class="required">*</span></label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">@lang('site.select_category')</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="price">@lang('site.price')</label>
                                    <input type="number" name="price" min="0" value="{{ old('price') }}" required class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="quantity">@lang('site.quantity')</label>
                                    <input type="number" min="0" name="quantity" value="{{ old('quantity') }}" required class="form-control">
                                </div>
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
