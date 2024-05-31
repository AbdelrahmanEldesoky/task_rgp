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

        <div class="row" style="display: block;">
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('products.create') }}" class="btn btn-primary">@lang('site.add_product')</a>
                                <button onclick="printData()" class="btn btn-primary">@lang('site.print')</button>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="searchInput" class="form-control" placeholder="@lang('site.search_for')">
                            </div>
                            <div class="col-md-4">
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
                            <table class="table table-striped jambo_table bulk_action" id="printTable">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">#</th>
                                        <th class="column-title">@lang('site.name')</th>
                                        <th class="column-title">@lang('site.price')</th>
                                        <th class="column-title">@lang('site.quantity')</th>
                                        <th class="column-title">@lang('site.Category')</th>
                                        <th class="column-title">@lang('site.image')</th>
                                        <th class="column-title no-link last no-print"><span class="nobr">@lang('site.action')</span></th>
                                    </tr>
                                </thead>
                                <tbody id="categoryTableBody">
                                    @foreach ($products as $index => $product)
                                    <tr class="even pointer">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                        @if($product->media->isNotEmpty())
                                            @foreach($product->media as $media)
                                                <img src="{{ $media->original_url }}" style="width: 100px" alt="@lang('site.no_image')" class="img-fluid">
                                            @endforeach
                                        @else
                                            <p>@lang('site.no_image')</p>
                                        @endif
                                    </td>
                                        <td class="no-print">
                                            <div class="row">
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-default"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                                <button class="btn btn-default deleteButton" data-category-name="{{ $product->name }}" data-category-id="{{ $product->id }}"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for search functionality and delete confirmation -->
<script>
  function printData() {
    // Show the "Action" column before printing
    var actionColumns = document.querySelectorAll('.no-print');
    actionColumns.forEach(column => column.style.display = 'table-cell');

    // Trigger the print dialog
    window.print();

    // Hide the "Action" column again after printing
    actionColumns.forEach(column => column.style.display = 'none');
  }

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

    var input = document.getElementById('searchInput');
    var tableBody = document.getElementById('categoryTableBody');

    input.addEventListener('input', function () {
      var searchText = input.value.toLowerCase();

      Array.from(tableBody.getElementsByTagName('tr')).forEach(function (row) {
        var nameColumn = row.getElementsByTagName('td')[1];

        if (nameColumn.textContent.toLowerCase().includes(searchText)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });

    var paginationLimitSelect = document.getElementById('paginationLimitSelect');

    paginationLimitSelect.addEventListener('change', function () {
      var paginationLimit = paginationLimitSelect.value;
      window.location.href = "{{ route('products.index') }}" + "?pagination_limit=" + paginationLimit;
    });
  });
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printTable, #printTable * {
            visibility: visible;
        }
        #printTable {
            position: absolute;
            left: 0;
            top: 0;
        }
        .no-print {
            display: none !important;
        }
    }
</style>

@endsection
