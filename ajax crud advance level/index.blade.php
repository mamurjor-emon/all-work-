@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('breadcrumb-right')
    <a href="{{ route('super.pages.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Create</a>
@endsection

@push('styles')
    <style>
        .accordion .card .card-header {
            padding: 1rem !important;
        }
        .accordion .card .card-header * {
            text-decoration: none;
            text-align: left;
        }
        .custom-border {
            border-top: 1px solid #cccccc80;
        }
        .badge{
            font-size: 10px;
        }



    </style>
@endpush

@section('content')

<div class="row">
    <div class="col-12 grid-margin mt-3">
        <div class="card">
            <h4 class="card-title">
                {{ $title }}
            </h4>
          <div class="card-body">
            <table class="table table-striped table-hover table-borderless w-100" id="pages_datatables">
                <thead class="custom_head">
                    <th style="width: 5%">SL</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th style="width: 5%">Action</th>
                </thead>
                <tbody>

                </tbody>
           </table>
          </div>
        </div>
      </div>
</div>

@endsection

@push('scripts')
    <script>
       tables = $('#pages_datatables').DataTable( {
            processing: true,
            serverSide: true,
            order: [], //Initial no order
            bInfo: true, //TO show the total number of data
            bFilter: false, //For datatable default search box show/hide
            responsive: true,
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100, 1000, 10000, -1],
                [5, 10, 15, 25, 50, 100, 1000, 10000, "All"]
            ],
            pageLength: 25, //number of data show per page
            ajax: {
                url: "{{ route('super.pages.get-data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {

                },
            },
            columns: [
                {data: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'feature_image'},
                {data: 'name'},
                {data: 'slug'},
                {data: 'status'},
                {data: 'action', orderable: false, searchable: false},
            ],
            language: {
                processing: '<img src="{{ asset("media/table-loading.svg") }}">',
                emptyTable: '<strong class="text-danger">No Data Found</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                oPaginate: {
                    sPrevious: "Previous", // This is the link to the previous page
                    sNext: "Next", // This is the link to the next page
                }
            },
            // dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6' <'float-end'B>>>" +
            // "<'row'<'col-sm-12'tr>>" +
            // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'<'float-end'p>>>",
            // buttons: {
            //     buttons: [
            //         {
            //             extend: 'pdf',
            //             filename: 'Pages_{{ date("d_m_d") }}',
            //             title_1: 'Pages Layouts',
            //             orientation: "portrait",
            //             pageSize: "A4",
            //             className: 'pdfButton btn btn-sm btn-primary',
            //             exportOptions: {
            //                 columns: '1,2,3,4,5,6,7'
            //             },
            //         },
            //         {
            //             extend: 'excel',
            //             filename: 'Pages_{{ date("d_m_d") }}',
            //             title_1: 'Pages Layouts',
            //             className: 'excelButton btn btn-sm btn-primary',
            //             exportOptions: {
            //                 columns: '0,1,2,3,4,5,6,7'
            //             },
            //         },
            //         {
            //             extend: 'csv',
            //             filename: 'Pages_{{ date("d_m_d") }}',
            //             title_1: 'Pages Layouts',
            //             className: 'csvButton btn btn-sm btn-primary',
            //             exportOptions: {
            //                 columns: '0,1,2,3,4,5,6,7'
            //             },
            //         },
            //         {
            //             extend: 'print',
            //             title_1: 'Pages List',
            //             orientation: "portrait",
            //             pageSize: "A4",
            //             className: 'printButton btn btn-sm btn-primary',
            //             exportOptions: {
            //                 columns: '0,1,2,3,4,5,6,7'
            //             },
            //             customize: function ( win ) {
            //                 $(win.document.body)
            //                     .addClass('bg-white')
            //                     .css('font-size','10pt');

            //                 $(win.document.body).find('table')
            //                     .addClass('compact bg-white')
            //                     .css('font-size','inherit' );
            //             }
            //         }
            //     ]
            // }
        });
    </script>
@endpush
