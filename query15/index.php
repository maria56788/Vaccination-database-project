<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Choose a person</title>
</head>
<body>
<h3>Search Schedule for Facility</h3>
<div class="row">
    <form action="query.php" class="col s12" method="post">
        <div class="row">
            <div class="input-field col s5">
                <label for="facilityID">Facility ID</label>
                <input type="number" name="facilityID"><br>
            </div>
            <div class="input-field col s5">
                <label for="date">Date</label>
                <input type="date" name="date"><br>
            </div>
            <div class="input-field col s2">
                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
