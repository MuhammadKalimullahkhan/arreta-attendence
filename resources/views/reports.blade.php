@extends('layout.base')

@section('mainContent')
  <section class="row">
    <div class="col-12">
      <h1 class="sectionTitle">Reports</h1>
    </div>
    <div class="col-12">
      <div class="table-responsive">
        <table id="dataTable" class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Role</th>
              <th>Job Level</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Aditya Wibowo</td>
              <td>Creative Director</td>
              <td>Senior Staff</td>
              <td>
                <span class="status-badge status-success">Active</span>
              </td>
            </tr>
            <tr>
              <td>Fahmi Pratama</td>
              <td>Project Manager</td>
              <td>Middle Staff</td>
              <td>
                <span class="status-badge status-success">Active</span>
              </td>
            </tr>
            <tr>
              <td>Fakhri Boden</td>
              <td>Fullstack Developer</td>
              <td>Junior Staff</td>
              <td>
                <span class="status-badge status-danger">Blocked</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  @endsection