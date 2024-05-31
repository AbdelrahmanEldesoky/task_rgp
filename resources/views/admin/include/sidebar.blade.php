          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> @lang('site.categories') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('categories.index')}}">@lang('site.manage_categories')</a></li>
                            <li><a href="{{route('categories.create')}}">@lang('site.add_category')</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i>@lang('site.products')<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('products.index')}}">@lang('site.manage_products')</a></li>
                            <li><a href="{{route('products.create')}}">@lang('site.add_product')</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
