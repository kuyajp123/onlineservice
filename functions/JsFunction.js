
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




$(document).ready(function() {
    // Intercept click event on elements with class 'ajax-link'
    $('.ajax-link').on('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        var url = $(this).attr('href'); // Get the URL from the href attribute

        // Perform the AJAX request
        $.ajax({
            url: url,
            method: 'GET', // Or 'POST' depending on your requirement
            success: function(response) {
                // Update the content container with the response
                $('#containerDivIDhere').html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('AJAX request failed:', status, error);
            }
        });
    });
});




















// magagamit moto in future!



// function for submitting data using ajax d pa nagana
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
    
    
//     // Function to get query string parameters
    // function getQueryParam(param) {
    //     const urlParams = new URLSearchParams(window.location.search);
    //     return urlParams.get(param);
    // }
    
    // // When the document is ready
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Get the user_no from URL
    //     const userNo = getQueryParam('user_no');
    
    //     // Assuming you have a modal with id 'myModal'
    //     if (userNo) {
    //         document.getElementById('myModal').querySelector('.modal-body').textContent = `User ID: ${userNo}`;
    //     }
    
    //     // Example for opening modal programmatically
    //     $('#myModal').modal('show');
    // });