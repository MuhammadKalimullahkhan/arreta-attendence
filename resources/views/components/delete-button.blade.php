<button class="dropdown-item text-danger" hx-delete="{{ $route }}" hx-target="closest tr"
    hx-on::confirm="return confirmAlert(event);" hx-on::after-request="successAlert('Deleted', 'Deletion successful.')">
    <i class="fa-solid fa-trash"></i>

    Delete
</button>
