@extends('staff.admin.adminmain')
@section('content')
<title>Admin Other Markets - Squid Market</title>
<!-- Other Markets Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Other Markets</h4>
</div>

<div style="margin-top: 30px; text-align: center">
    <td><a class="btn btn-sm btn-primary" href="">Add Market</a></td>
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
                        <th scope="col">Market Name</th>
                        <th scope="col">Sales</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Orga Market</td>
                        <td>5466</td>
                        <td>4.5/5</td>
                        <td><a class="btn btn-sm btn-primary" href="">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Orga Market</td>
                        <td>5466</td>
                        <td>5/5</td>
                        <td><a class="btn btn-sm btn-primary" href="">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Orga Market</td>
                        <td>5466</td>
                        <td>3/5</td>
                        <td><a class="btn btn-sm btn-primary" href="">Edit</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Other Markets End -->
@stop