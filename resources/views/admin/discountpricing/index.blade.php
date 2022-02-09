@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
    <style>
.disabled-link {
  pointer-events: none;
}
</style>
    @endsection
@section('content')
   
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Discount Pricing</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="table-th-wrapper" scope="col"># No</th>
                        <th class="table-th-wrapper" scope="col">Coustomer Group</th>
                        <th class="table-th-wrapper" scope="col">Brand</th>
                        <th class="table-th-wrapper" scope="col">Product</th>
                        <th class="table-th-wrapper" scope="col">Ctn Qty</th>
                        <th class="table-th-wrapper" scope="col">Or More</th>
                        <th class="table-th-wrapper" scope="col">Discount Rate %</th>
                        <th class="table-th-wrapper" scope="col">Active</th>
                        <th class="table-th-wrapper" scope="col">Start Date</th>
                        <th class="table-th-wrapper" scope="col">End Date</th>
                        <th class="table-th-wrapper" scope="col">Delete</th>
                        <th class="table-th-wrapper" scope="col">Sales Review</th>
                    </tr>
                </thead>
                <tbody class="week-container-tbl">
                   
                </tbody>
            </table>
        </div>
    </div>
    <div class="container specfic_deliveries" style="display: none;margin-bottom: 50px;">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Specific Weeks Deliveries</h2>
            </div>
        </div>
        <div class="table_details">

        </div>
    </div>
@endsection