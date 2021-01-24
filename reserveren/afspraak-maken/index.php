<?php
session_start();
include '../initialize.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../.css">
    <title>Ana</title>
</head>
<body>


<div class="container">
    <div class="inserts">
        <h1>Reservation Form</h1>
        <form action="" method="post">
            <input type="text" name="username"  placeholder=" Name " required=""><br>
            <input type="email" name="email"  placeholder=" Email "   required=""><br>
            <input type="text" name="phone"  placeholder=" Phone number "   required=""><br>
            <input type="text" name="location"  placeholder=" Location "  required=""><br>
            <input type="date" name="date" placeholder="DD-MM-YYYY" required="">
            <input type="time" name="time" placeholder="00:00" required="">

            <input type="submit" name="submit_appointment" value="Submit">
        </form>
    </div>
    <div class="views">
        <h1>Overview</h1>
        <h2>
            All Reservations Made Today <?php echo date('D, d M Y');?>
        </h2>
        <div class="links">

            <?php
            $query = "SELECT * FROM appointments";
            $return = mysqli_query($db, $query);
            ?>

        <?php    if($return): ?>

             <?php   if (mysqli_num_rows($return) > 0): ?>

               <?php
                    $new_reserv = mysqli_fetch_all($return, MYSQLI_ASSOC);

                 foreach ($new_reserv as $value): ?>
                        <div class="body">
                            <h4>Naam: <?php echo escape($value['username']) ?></h4>
                            <p>Datum:  <?=  escape($value['date']) ?></p>
                            <p>Tijd: <?=  escape($value['time']) ?></p>
                            <a style="border-radius: 8px;background-color: #020202;color: white;" href="../view.php?detail=<?php echo $value['id'] ?>"> Details </a>
                        </div>
            <?php endforeach ; ?>
            <?php endif; ?>

        <?php endif; ?>

        </div>
        <p style="color: white;"> <strong>NOTE:</strong> THIS SECTION WILL BE VISIBLE TO ADMINISTRATORS</p>
    </div>
</div>
</body>
</html>
