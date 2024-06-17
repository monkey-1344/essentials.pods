<!DOCTYPE html>
<?php
    include 'components/header.php';
?>
        <!-- Header-->
        <header class="py-5 header-color">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Essentials.pods</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Ascultă lumea altfel</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-md-3 row-cols-xl-4 justify-content-center row-cols-sm-1">
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                        <h4>AirPods Pro 2</h4>
                        <p>Căști de înaltă calitate, perfect identice cu modelul original, inclusiv toate inscripțiile pe carcasă și căști. Vin într-o cutie autentică și oferă un sunet clar și puternic, cu bas profund și microfon încorporat. Bateria lor durează în medie 5-6 ore de utilizare și până la 3-4 săptămâni în modul standby. Dispun de MagSafe și FastCharge pentru o încărcare rapidă și eficientă. Aceste căști sunt compatibile cu funcția "Find My" în caz de pierdere și oferă toate funcțiile posibile. Au un număr de serie valid și sunt compatibile și cu dispozitivele Android.</p>
                        <a href="cart.php">
                        <button class="btn btn-outline-dark justify-content-center">
                            <i class="bi bi-headphones"></i>
                            330 RON
                        </button>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                        <img src="images/airpods.png" class="img-fluid">
                    </div>
                </div>

                <h4>Reviews</h4>

                <?php
                // Database connection parameters
                require_once 'components/config.php';

                // Create connection
                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to retrieve the first three rows from your_table (adjust table name accordingly)
                $sql = "SELECT review FROM reviews LIMIT 3";
                $result = $conn->query($sql);

                // Displaying the results in a grid layout
                if ($result->num_rows > 0) {
                    echo "<div class='row'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4 col-sm-12' style='border: 1px solid #ccc; padding: 10px;'>";
                        echo "<p>" . htmlspecialchars($row["review"]) . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "0 results";
                }

                // Close connection
                $conn->close();
                ?>
                <div style="height: 10px"></div>
                <h4>Adaugă un review</h4>
                <form id="review_form" class="row">
                    <div class="col-md-11 col-sm-11">
                        <input type="text" class="form-control" id="review" name="review" required>
                    </div>
                    <div class="col-md-1 col-sm-1">
                        <button type="submit" class="btn btn-outline-dark">Submit</button>
                    </div>
                </form>
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
                        $('#review_form').on('submit', function(event) {
                            event.preventDefault();

                            $.ajax({
                                url: 'insert_review.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(response) {
                                    $('#response').html(response);
                                    $('#responseModal').modal('show');
                                    $('#ajax-form')[0].reset();
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
<?php
include 'components/footer.php';