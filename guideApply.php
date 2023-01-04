<?php session_start(); ?>
<?php
if (isset($_POST["submit"])) {
    require_once 'admin/Database_conn.php';
    $name = $_POST["name"];
    $region = $_POST["region"];
    $district = $_POST["district"];
    $age = $_POST["age"];
    $map = $_POST["map"];
    $phone = $_POST["phone"];
    $nidNo = $_POST["nidNo"];
    $request = 'pending';
    $sql = "INSERT INTO `guides`(`name`, `region`, `district`, `map`, `age`, `nidNo`, `phone`, `available`,`guideRequest`) VALUES ( '$name',' $region ' ,'$district','$map','$age','$nidNo','$phone','no',' $request' )";
    mysqli_query($conn, $sql);
    //mysqli_close($conn);
    header('location: guideApplied.php');
}
?>
<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>About Us | Tour&Travel</title>

    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<!-- HEAD TAG ENDS -->

<!-- BODY TAG STARTS -->

<body>

    <?php

    if (!isset($_SESSION["username"])) {
        include("common/headerLoggedOut.php");
    } else {
        include("common/headerLoggedIn.php");
    }

    ?>

    <div class="spacer">a</div>

    <div class="col-sm-12 aboutUsWrapper">

        <div class="headingOne">

            Apply to Bocome a Guide.

        </div>


        <div class="container-fluid" style="margin: 0 auto;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="">

                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <h4>Name</h4>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name " required>
                                </div>


                                <div class="col-xs-6">
                                    <h4>Phone No </h4>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone No" value="" required>
                                </div>


                                <div class="col-xs-12">
                                    <h4>Select region</h4>
                                    <div><select class="form-control" name="region" required />
                                        <option value="">Select</option>

                                        <?php
                                        require_once "admin/Database_conn.php";
                                        $s = "select * from region";
                                        $result = mysqli_query($conn, $s);
                                        $r = mysqli_num_rows($result);
                                        //echo $r;

                                        while ($data = mysqli_fetch_array($result)) {
                                            if (isset($_POST["show"]) && $data[0] == $_POST["region"]) {
                                                echo "<option value=$data[0] selected='selected'>$data[1]</option>";
                                            } else {
                                                echo "<option value=$data[0]>$data[1]</option>";
                                            }
                                        }



                                        ?>
                                        </select>
                                        <input type="submit" value="Show" name="show" formnovalidate />
                                    </div>

                                </div>

                                <div class="col-xs-12">
                                    <h4>Select District</h4>
                                    <div><select class="form-control" name="district" required />
                                        <option value="">Select</option>


                                        <?php

                                        $s = "select * from district";
                                        $result = mysqli_query($conn, $s);
                                        $r = mysqli_num_rows($result);
                                        //echo $r;

                                        while ($data = mysqli_fetch_array($result)) {
                                            if (isset($_POST["show"])) {
                                                if ($data[2] == $_POST["region"]) {
                                                    echo "<option value=$data[0] >$data[1]</option>";
                                                } else {
                                                    //	echo "<option value=$data[0]>$data[1]</option>";
                                                }
                                            }
                                        }



                                        ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-xs-6">
                                    <h4>Age</h4>
                                    <input type="number" name="age" class="form-control" placeholder="Enter Age " value="" required>
                                </div>


                                <div class="col-xs-6">
                                    <h4>NID No</h4>
                                    <input type="text" name="nidNo" class="form-control" placeholder="Enter NID Number" value="" required>
                                </div>

                                <div class="col-xs-6">
                                    <h4>Embed Map from google</h4>
                                    <input type="text" name="map" class="form-control" placeholder="Enter embeded map" value="" required>
                                </div>


                                <div>
                                    <input type="submit" class="btn btn-success btn-block btn-lg" name="submit" value="Apply">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>


    </div> <!-- paymentWrapper -->

    <div class="spacerLarge">.</div> <!-- just a dummy class for creating some space -->

    <?php include("common/footer.php"); ?>

</body>

<!-- BODY TAG ENDS -->

</html>