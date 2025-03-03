@extends('layout.base')
@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Payhead
                <small class="text-muted">List of all payhead</small>
            </h1>
            <button
                type="button"
                class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#createModal"
                onclick="openModal(null)">
                Add Pay Head
            </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Added By</th>
                                <th>Added At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payHeads as $payHead)
                                <tr>
                                    <td>{{ $payHead->description }}</td>
                                    <td>{{"Kalimullah"}} <small>soon</small></td>
                                    <td>{{ \Carbon\Carbon::parseDate($payHead->created_at) }}</td>
                                    <td>{{ \Carbon\Carbon::parseDate($payHead->updated_at) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                <ion-icon name="create"></ion-icon>
                                            </button>
                                            <ul class="dropdown-menu shadow-lg">
                                                <li>
                                                    <button
                                                        class="dropdown-item text-success"
                                                        onclick="confirmAlert(event, ()=>openModal({{$payHead->id}}))">
                                                        <ion-icon name="create"></ion-icon>
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <x-delete-button route="{{ route('pay-heads.destroy', $payHead->id) }}" />
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--   Add Modal --}}
    @include("pay-heads.add-modal")
    {{--    @include("pay-heads.edit-modal", ["id"=>1])--}}
@endsection

@section('scripts')
    <script src="/js/utils.js"></script>
    <script>
        function openModal(id = null) {
            if (id) {
                // Edit mode
                $('.modal .modal-title').text('Edit Pay Head');
                $('.modal form button[type="submit"]').text('Update');

                $.get('{{ route("pay-heads.index") }}' + '/' + id, function (response) {
                    if (response.success) {
                        const payHead = formatObject(response.data[0]);
                        populateValues(payHead) // set values to form
                    }
                });
            } else {
                // Create mode
                $('.modal .modal-title').text('Add Pay Head');
                $('.modal form button[type="submit"]').text('Create');

                $('#payHeadId').val(null);
                $('#createModal form')[0].reset();
            }
            $('#createModal').modal('show');
        }

        $('#createModal form').submit(function (event) {
            event.preventDefault();

            let id = $('#payHeadId').val();
            let url = id ? '{{ route("pay-heads.index") }}/' + id : '{{ route("pay-heads.store") }}';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $('#createModal').modal('hide');
                        location.reload(); // Reload page to update data
                    }
                },
                error: function (xhr) {
                    dangerAlert("Failed", "Failed to update/create.");
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection
