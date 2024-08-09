<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Modal with Air Datepicker</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Air Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@2.3.0/dist/css/datepicker.min.css">
    <style>
        /* Ensure Air Datepicker appears on top of the modal */
        .air-datepicker {
            z-index: 1051; /* Bootstrap modals use z-index: 1050 */
        }
    </style>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="editbirthdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new Birthday</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row g-3 px-3 pt-2">
                    <div class="col">
                        <form action="">
                            <div class="mb-0">
                                <input id="datepicker" class="input_el__l_VZt" readonly placeholder="Choose date" value="">
                            </div>
                    </div>
                </div>
                <div class="mb-3 px-3">
                    <label for="formGroupExampleInput2" class="form-label" style="padding-top:10px;">Confirmation</label>
                    <input type="password" class="form-control" name="user_password" id="editnamepass" placeholder="Enter your password" required="required">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Air Datepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/air-datepicker@2.3.0/dist/js/datepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Custom button content and behavior
            let button = {
                content: 'Select 2021-07-26',
                className: 'custom-button-classname',
                onClick: (dp) => {
                    dp.setViewDate(new Date('2021-07-26'));
                }
            };

            // Initialize Air Datepicker
            new AirDatepicker('#datepicker', {
                buttons: [button, 'clear'], // Custom button and 'clear' button
                dateFormat: 'yyyy-mm-dd',
                autoClose: true
            });
        });
    </script>
</body>
</html>
