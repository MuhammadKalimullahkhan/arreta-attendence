const hamBurgerIcon = document.querySelector("#burger-icon");
const sidebar = document.querySelector("aside");

hamBurgerIcon.addEventListener("click", () => {
  sidebar.classList.toggle("show");
});

// datatable
$(document).ready(function () {
  $("#dataTable").DataTable({
    pageLength: 4,
    pagingType: "full_numbers", // Use Bootstrap-style pagination
    lengthMenu: [4, 5, 10, 25, 50], // Define page size options
    language: {
      paginate: {
        first: `<ion-icon name="chevron-back-outline"></ion-icon>`, // First page icon
        last: `<ion-icon name="chevron-forward-outline"></ion-icon>`, // Last page icon
        next: `<ion-icon name="arrow-forward-circle-outline"></ion-icon>`, // Next page icon
        previous: `<ion-icon name="arrow-back-circle-outline"></ion-icon>`, // Previous page icon
      },
    },
  }); // Initialize DataTable
});
