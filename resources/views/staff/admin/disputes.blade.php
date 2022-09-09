@extends('staff.admin.adminmain')
@section('content')
<title>Admin Disputes - Squid Market</title>
<!-- Disputes Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Disputes</h4>
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
                        <th scope="col">Created On</th>
                        <th scope="col">Product</th>
                        <th scope="col">Buyer</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Order #</th>
                        <th scope="col">Executor</th>
                        <th scope="col">Winner</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($disputes as $dispute)
                    <tr>
                        <td>{{ date('m/d/y', strtotime($dispute->created_at)) }}</td>
                        <td>{{ $dispute->product()->name }}</td>
                        <td>{{ $dispute->buyer()->username }}</td>
                        <td>{{ $dispute->seller()->username }}</td>
                        <td>{{ $dispute->order()->id }}</td>
                        <td>{{ $dispute->excutor()->username }}</td>
                        <td>{{ $dispute->winner()->username }}</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="color:red;text-align:center">Looks empty :(</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Disputes End -->
@stop