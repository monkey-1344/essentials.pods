<?php
@include ("components/header.php");

?>

<body>
<header class=" header-color py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Essentials.pods</h1>
            <p class="lead fw-normal text-white-50 mb-0">Comandă</p>
        </div>
    </div>
</header>
<section class="py-5 form-cart">
    <div class="container px-4 px-lg-5 mt-5">

        <!-- Form -->
<form id="ajax-form">
    <div class="mb-3">
        <label for="name" class="form-label">Nume:</label>
        <input type="text" id="name" name="nume" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Prenume:</label>
        <input type="text" class="form-control" id="surname" name="prenume" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="phone_number" class="form-label">Număr de telefon:</label>
        <input type="text" class="form-control" id="phone_number" name="nr_telefon" required>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Cantitate:</label>
        <input type="text" class="form-control" id="quantity" value="1"  name="produs" required>
    </div>
    <div class="mb-3">
        <label for="county" class="form-label">Județ:</label>
        <input type="text" class="form-control" id="county"  name="judet" required>
    </div>
    <div class="mb-3">
        <label for="town" class="form-label">Oraș:</label>
        <input type="text" class="form-control" id="town" name="oras" required>
    </div>
    <div class="mb-3">
        <label for="adress" class="form-label">Adresă:</label>
        <input type="text" class="form-control" id="adress" placeholder="Stradă, Număr"  name="adresa" required>
    </div>
    <div class="row">
        <div class="col-md-1 col-sm-1">
            <button type="submit" class="btn btn-primary">Trimite</button>
        </div>
        <div class="col-md-3 col-sm-3" id="priceResult"  style="padding-left: 30px"></div>
    </div>

</form>
        <!-- Modal -->
        <div id="responseModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="responseModalLabel">Vă mulțumim</h5>
                    </div>
                    <div class="modal-body" id="response">
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                function calculatePrice() {
                    var quantity = $('#quantity').val(); // Get the value from input field

                    // Make AJAX request
                    $.ajax({
                        url: 'calculate_price.php', // PHP script to handle the calculation
                        method: 'POST',
                        data: { quantity: quantity }, // Data to send to the server
                        success: function(response) {
                            $('#priceResult').html('<h5>Preț: ' + response + ' RON</h5>'); // Display the result
                        }
                    });
                }

                // Trigger price calculation on page load
                calculatePrice();

                // Trigger price calculation on input change
                $('#quantity').on('input', function() {
                    calculatePrice();
                });
                $('#ajax-form').on('submit', function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: 'submit_form.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#response').html(response);
                            $('#responseModal').modal('show');
                            $('#ajax-form')[0].reset(); // Clear form fields
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#response').html('An error occurred: ' + textStatus);
                            $('#responseModal').modal('show');
                        }
                    });
                });
            });

        </script>
    </div>
</section>
</body>
<?php
@include ("components/footer.php");
?>

