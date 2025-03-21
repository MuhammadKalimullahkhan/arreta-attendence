@extends('layout.base')

@section('mainContent')
    <section class="row">
        <div class="col-12">
            <h1 class="sectionTitle">Profile</h1>
        </div>

        <div class="col-12">
            <div class="card card-body">
                <form action="">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" value="{{ $currentUser->name }}" class="form-control"
                                disabled />
                        </div>
                        <div class="col-lg-4">
                            <label for="nic" class="form-label">CNIC</label>
                            <input id="nic" type="text" value="{{ $currentUser->cnic }}" class="form-control"
                                disabled />
                        </div>
                        <div class="col-lg-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="eamil" type="text" value="{{ $currentUser->email }}" class="form-control"
                                disabled />
                        </div>
                        <div class="col-lg-4">
                            <label for="role" class="form-label">Role</label>
                            <input id="role" type="text" value="{{ $currentUser->role->description }}"
                                class="form-control" disabled />
                        </div>
                        {{-- <div class="col-lg-4">
                            <label for="salary" class="form-label">Salary</label>
                            <input id="salary" type="number" placeholder="50,000" class="form-control" />
                        </div>
                        <div class="col-lg-4">
                            <label for="taxDeduction" class="form-label">Tax Deduction</label>
                            <input id="taxDeduction" type="number" placeholder="10%" class="form-control" />
                        </div>
                        <div class="col-lg-4">
                            <label for="insuranceDeduction" class="form-label">Insurance Deduction</label>
                            <input id="insuranceDeduction" type="number" placeholder="100" class="form-control" />
                        </div>
                        <div class="col-lg-4">
                            <label for="eobiDeduction" class="form-label">Eobi Deduction</label>
                            <input id="eobiDeduction" type="number" placeholder="100" class="form-control" />
                        </div>
                        <div class="col-lg-4">
                            <label for="otherDeduction" class="form-label">Other Deduction</label>
                            <input id="otherDeduction" type="number" placeholder="100" class="form-control" />
                        </div> --}}
                        <div class="col-12">
                            <a class="btn btn-primary" href="/">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
