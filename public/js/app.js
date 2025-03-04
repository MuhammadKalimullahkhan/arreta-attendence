const hamBurgerIcon = document.querySelector("#burger-icon");
const sidebar = document.querySelector("aside");

// datatable
$(document).ready(function () {
    hamBurgerIcon.addEventListener("click", () => {
        sidebar.classList.toggle("show");
    });

    $("#dataTable").DataTable({
        pageLength: 10,
        pagingType: "full_numbers", // Use Bootstrap-style pagination
        lengthMenu: [10, 25, 50], // Define page size options
        language: {
            paginate: {
                first: `<ion-icon name="chevron-back-outline"></ion-icon>`, // First page icon
                last: `<ion-icon name="chevron-forward-outline"></ion-icon>`, // Last page icon
                next: `<ion-icon name="arrow-forward-circle-outline"></ion-icon>`, // Next page icon
                previous: `<ion-icon name="arrow-back-circle-outline"></ion-icon>`, // Previous page icon
            },
        },
    }); // Initialize DataTable

    $(".select2").select2({
        width: "100%",
        dropdownParent: $(".parent"),
    });
});


// sweet alerts
function myAlert(title, message, icon) {
    Swal.fire({
        title,
        text: message,
        icon,
        timer: 5000,
    });
}
const successAlert = (title, message) => myAlert(title, message, "success");
const dangerAlert = (title, message) => myAlert(title, message, "error");

const confirmAlert = (event, onSuccess = null) => {
    event.preventDefault(); // Stop HTMX from sending request immediately

    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            if (onSuccess) onSuccess();
            else event.detail.issueRequest(); // Manually trigger HTMX request
        }
    });
};
