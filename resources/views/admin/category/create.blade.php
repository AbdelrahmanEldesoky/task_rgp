@extends('layouts.admin.app')
@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>@lang('site.manage_categories')</h3>
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
                        <br />

                            <form method="POST" action="{{ route('categories.store') }}"enctype="multipart/form-data">
                                @csrf
                                @foreach($languages as $localeCode => $properties)

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
                                            <input id="title_{{ $localeCode }}" name="name[{{ $localeCode }}]" value="" required type="text" class="form-control">
                                        </div>
                                    </div>
                                </section>
                            @endforeach

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