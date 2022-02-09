@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    {{-- <style>
        .disabled-link {
            pointer-events: none;
        }

    </style> --}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('discountpricing.create') }}" class="btn btn-primary pull-right"><i
                                    class="fas fa-fw fa-plus"></i>Add Discount Pricing</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Discount Pricing's List
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="discount-pricing-tbl" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th># No</th>
                                        <th>Coustomer Group</th>
                                        <th>Brand</th>
                                        <th>Product</th>
                                        <th>Ctn Qty</th>
                                        <th>Or More</th>
                                        <th>Discount Rate %</th>
                                        <th>Active</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Delete</th>
                                        <th>Sales Review</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id ?? '' }}</td>
                                            {{-- @dd($row->groups()->first()->group_name) --}}
                                            <td>{{ $row->group()->first()->group_name ?? '' }}</td>
                                            <td>{{ $row->brand ?? '' }}</td>
                                            <td>{{ $row->product()->first()->name ?? '' }}</td>
                                            <td>{{ $row->ctn_qty ?? '' }}</td>
                                            <td>
                                                @if ($row->or_more == 1)
                                                    <span class="badge badge-success">Yes</span>
                                                @else <span <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $row->discount_rate ?? '' }}</td>
                                            <td>
                                                @if ($row->is_active == 1)
                                                    <span class="badge badge-success">Yes</span>
                                                @else <span <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                            </td>
                                            <td>{{ date('d/m/Y', strtotime($row->start_date)) ?? '' }}</td>
                                            <td>{{ date('d/m/Y', strtotime($row->finish_date)) ?? '' }}</td>
                                            <td>
                                                <form action="{{ route('discountpricing.destroy', $row->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?');"
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                                </form>
                                                {{-- <a onclick="return confirm('Are you sure?')" href="" style="color:white;"
                                                    class="btn btn-sm btn-danger">Delete</a> --}}
                                            </td>
                                            <td><a style="color:white;" class="btn btn-sm btn-primary">View</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#discount-pricing-tbl').DataTable();
        });
    </script>
@endsection
