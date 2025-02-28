<div class="dropdown">
    <button
        style="background: none; border: none"
        type="button"
        data-bs-toggle="dropdown">
        <ion-icon name="ellipsis-vertical-outline"></ion-icon>
    </button>
    <ul class="dropdown-menu shadow-lg">
        <li>
            <x-edit-button id="{{ $itemId }}"/>
        </li>
        <li>
            <x-delete-button route="{{ $route }}"/>
        </li>
    </ul>
</div>
