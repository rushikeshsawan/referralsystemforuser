<?php

// print_r($firstDirect);
// die();
?>


<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>


    <?php
    include "Partials/Navbar.php";
    $totalcommision=0;
    ?>
    <div class="container m-5 row col-6">
        <h1> Level Wise Commision </h1>
        <hr><br>
        <table class="table table-hover mt-5 pt-5 text-center">
            <thead>
                <tr>
                    <th scope="col">level</th>
                    <th scope="col">Total Referrals</th>
                    <th scope="col">Commision</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($firstDirect)) {
                ?>
                    <tr>
                        <td>1</td>
                        <td><?= $firstDirect['totalreferral'] ?></td>
                        <td>&#8377; <?= $firstDirect['commision'] ?></td>
                        <?php $totalcommision += $firstDirect['commision']; ?>
                    </tr>
                <?php
                }
                ?>

<tr>
                        <td colspan="2" class="text-danger offset-1"><b>Total Daily Commision</b></td>
                        <td colspan="1" class="text-danger"><b> &#8377; <?= $totalcommision ?></b></td>
                       
                    </tr>

             

            </tbody>
        </table>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>