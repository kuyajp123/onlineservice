
// show password
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".toggle-password").addEventListener("click", function() {
        var passwordField = document.getElementById("user_password");
        var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });
});

// show modal
function openModal(modalId) {
    const modalElement = document.getElementById(modalId);
    if (modalElement) {
        $(modalElement).modal('show');
    } else {
        console.error(`Modal with ID ${modalId} not found.`);
    }
}

// Event listeners for elements that should open modals
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-open-modal]').forEach(element => {
        element.addEventListener('click', function(event) {
            const modalId = element.getAttribute('data-open-modal');
            openModal(modalId);
        });
    });
});


// sticky navbar in profile.php
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}









// magagamit moto in future!



// // function for submitting data using ajax d pa nagana
// $(document).ready(function() {
//     // Show the modal on page load
//     $('#autoOpenModal').modal('show');

//     // Handle form submission
//     $('#dataForm').on('submit', function(event) {
//       event.preventDefault(); // Prevent form from submitting normally
//       const inputData = $('#inputData').val();
//       // Send data to the server (e.g., using AJAX)
//       $.ajax({
//         url: 'process_form.php', // Replace with your server endpoint
//         type: 'POST',
//         data: { inputData: inputData },
//         success: function(response) {
//           // Handle success
//           $('#result').html('<div class="alert alert-success">Data submitted successfully!</div>');
//         },
//         error: function(error) {
//           // Handle error
//           $('#result').html('<div class="alert alert-danger">Error submitting data.</div>');
//         }
//       });
//     });
//   });




// //   for modal to prevent refereshing modal if the website refreshed d pa nagana
//   $(document).ready(function() {
//     // Show the modal on page load
//     $('#autoOpenModal').modal('show');

//     // Prevent anchor tag clicks from reloading the page
//     $('a').on('click', function(event) {
//       event.preventDefault();
//       // Handle anchor click here
//     });
//   });
//   $(document).ready(function() {
//     // Show the modal on page load
//     $('#autoOpenModal').modal('show');

//     // Prevent form submission from reloading the page
//     $('form').on('submit', function(event) {
//       event.preventDefault();
//       // Handle form submission here
//     });
// });

