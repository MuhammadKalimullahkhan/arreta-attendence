@extends('layout.base') 
@section('mainContent')

<section class="row">
    <div class="col-12">
        <h1 class="sectionTitle">Attendance</h1>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee</th>
                                <th>Estimation Date</th>
                                <th>Duration</th>
                                <th>Permission Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>21918</td>
                                <td>Anugrah Prasetya</td>
                                <td>24 - 25 July</td>
                                <td>24 Hours</td>
                                <td>Sick leave</td>
                                <td>
                                    <button class="btn btn-success">
                                        Approve
                                    </button>
                                    <button class="btn btn-danger">✖</button>
                                </td>
                            </tr>
                            <tr>
                                <td>37189</td>
                                <td>Denny Malik</td>
                                <td>22 - 24 August</td>
                                <td>2 Days</td>
                                <td>Annual leave</td>
                                <td>
                                    <span class="text-danger">Rejected</span>
                                </td>
                            </tr>
                            <tr>
                                <td>41521</td>
                                <td>Silvia Cintia Bakri</td>
                                <td>01 - 30 August</td>
                                <td>30 Days</td>
                                <td>Maternity leave</td>
                                <td>
                                    <span class="text-success">Approved</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
