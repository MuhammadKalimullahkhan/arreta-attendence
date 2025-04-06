<div class="dropdown">
    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="fa-solid fa-ellipsis-vertical"></i>
        <span class="visually-hidden">Actions</span>
    </button>
    <ul class="dropdown-menu shadow-lg">
        <li>
            <x-edit-button id="{{ $itemId }}" />
        </li>
        <li>
            <x-delete-button route="{{ $route }}" />
        </li>
    </ul>
</div>
