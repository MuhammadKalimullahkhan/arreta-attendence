<div class="modal fade parent" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Pay Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pay-heads.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="payHeadId" />
                    <!-- Head Type Dropdown -->
                    <div class="mb-3">
                        <label for="headType" class="form-label">
                            Head Type
                            <span class="text-danger">*</span>
                        </label>
                        <select id="headType" name="payHeadTypeId" class="form-select select2" required>
                            <option selected disabled value>Select Pay Head Type</option>
                            @foreach ($payHeadTypes as $payHeadType)
                                <option value="{{ $payHeadType->id }}">{{ $payHeadType->description }}</option>
                            @endforeach
                        </select>
                        <div id="error_payHeadTypeId" class="text-danger text-xs"></div>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span
                                class="text-danger">*</span></label>
                        <input type="text" id="description" name="description" placeholder="Enter description"
                            class="form-control" />
                        <div id="error_description"class="text-danger text-xs"></div>
                    </div>

                    <!-- Is Editable Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" id="isEditable" name="isEditable" class="form-check-input" />
                        <label class="form-check-label" for="isEditable">Is Editable</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
