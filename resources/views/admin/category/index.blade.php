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

        <div class="row" style="display: block;">

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-4 ">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">@lang('site.add_category')</a>
                    </div>
                        <div class="col-md-4 ">
                            <input type="text" id="searchInput" class="form-control" placeholder="{{ __('site.search_for') }}">
                        </div>
                        <div class="col-md-4 ">
                        <select id="paginationLimitSelect" class="form-control">
                            <option value="5" {{ $paginationLimit == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $paginationLimit == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $paginationLimit == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $paginationLimit == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $paginationLimit == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title"># </th>
                                        <th class="column-title">@lang('site.name')</th>
                                        <th class="column-title no-link last"><span class="nobr">@lang('site.action')</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody id="categoryTableBody">
                                    @foreach ($categories as $index=>$category)
                                    <tr class="even pointer">
                                        <td>{{$index+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-default"><i class="fa fa-edit"> @lang('site.edit')</i></a>

                                                <form id="deleteForm{{$category->id}}" action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="button" class="btn btn-default deleteButton" data-category-name="{{$category->name}}" data-category-id="{{$category->id}}"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- JavaScript for search functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the input field and table body
        var input = document.getElementById('searchInput');
        var tableBody = document.getElementById('categoryTableBody');

        // Add event listener to input field for capturing user input
        input.addEventListener('input', function () {
            var searchText = input.value.toLowerCase(); // Convert input to lowercase for case-insensitive search

            // Loop through each row in the table body
            Array.from(tableBody.getElementsByTagName('tr')).forEach(function (row) {
                var nameColumn = row.getElementsByTagName('td')[1]; // Get the category name column

                // Check if the category name contains the search text
                if (nameColumn.textContent.toLowerCase().includes(searchText)) {
                    row.style.display = ''; // Show the row if it matches the search
                } else {
                    row.style.display = 'none'; // Hide the row if it doesn't match the search
                }
            });
        });

        // Get the select dropdown for pagination limit
        var paginationLimitSelect = document.getElementById('paginationLimitSelect');

        // Add event listener to select dropdown for capturing user input
        paginationLimitSelect.addEventListener('change', function () {
            var paginationLimit = paginationLimitSelect.value; // Get the selected pagination limit

            // Redirect to the same page with the new pagination limit
            window.location.href = "{{ route('categories.index') }}" + "?pagination_limit=" + paginationLimit;
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.deleteButton');
        var deleteAskMessage = @json(__('site.delete_ask'));

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                var categoryName = this.getAttribute('data-category-name');
                var categoryId = this.getAttribute('data-category-id');

                var confirmation = confirm(deleteAskMessage + categoryName + "'?");

                if (confirmation) {
                    document.getElementById('deleteForm' + categoryId).submit();
                }
            });
        });
    });
</script>

@endsection
