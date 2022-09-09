@extends('staff.admin.adminmain')
@section('content')
<title>Admin Vendors - Squid Market</title>
<!-- Products Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Products</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="d-none d-md-flex">
        <input class="form-control bg-secondary border-0 mb-3" style="width:300px;margin-left:auto" type="search"
            placeholder="Search">
    </form>
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Listed On</th>
                        <th scope="col">Product</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Total Sold $</th>
                        <th scope="col">Feedbacks</th>
                        <th scope="col">Category</th>
                        <th scope="col">Violation</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->created_at->format('m/d/y') }}</td>
                        <td>{{ $product->name }}</td>
                        <td>0</td>
                        <td>$0</td>
                        <td>0</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->checkViolate() }}</td>
                        <td><a class="btn btn-sm btn-primary" href="">Delete</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Edit</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="color:red;text-align:center;">Looks empty :(</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Products End -->
@stop