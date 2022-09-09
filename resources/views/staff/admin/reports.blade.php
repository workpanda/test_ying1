@extends('staff.admin.adminmain')
@section('content')
<title>Admin Vendors - Squid Market</title>
<!-- Reports Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Reports</h4>
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
                        <th scope="col">Reported On</th>
                        <th scope="col">Report</th>
                        <th scope="col">Complainant</th>
                        <th scope="col">Suspect</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>


                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01/01/22</td>
                        <td>This vendor asked me to contact him outside the market</td>
                        <td>squidbuyer</td>
                        <td>Rockleo</td>
                        <td><a class="btn btn-sm btn-primary" href="">Accept</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Reject</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Ban Suspect</a></td>
                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>This vendor asked me to contact him outside the market</td>
                        <td>squidbuyer</td>
                        <td>Rockleo</td>
                        <td><a class="btn btn-sm btn-primary" href="">Accept</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Reject</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Ban Suspect</a></td>
                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>This vendor asked me to contact him outside the market</td>
                        <td>squidbuyer</td>
                        <td>Rockleo</td>
                        <td><a class="btn btn-sm btn-primary" href="">Accept</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Reject</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Ban Suspect</a></td>
                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>This vendor asked me to contact him outside the market</td>
                        <td>squidbuyer</td>
                        <td>Rockleo</td>
                        <td><a class="btn btn-sm btn-primary" href="">Accept</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Reject</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Ban Suspect</a></td>
                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>This vendor asked me to contact him outside the market</td>
                        <td>squidbuyer</td>
                        <td>Rockleo</td>
                        <td><a class="btn btn-sm btn-primary" href="">Accept</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Reject</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Ban Suspect</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Reports End -->
@stop