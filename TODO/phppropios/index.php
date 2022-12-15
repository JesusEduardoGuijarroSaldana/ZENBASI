<?php
include_once 'database.php';
    $select = "SELECT * FROM tbl_select";
    $result = mysqli_query ($connection, $select);

    $message   =  '';
    if(isset($_POST['submit']))
    {
        $name       =   $_POST['name'];
        $country    =   $_POST['country'];
    
        // Attempt insert query execution
        $insert = "INSERT INTO tbl_insert (name, country) VALUES ('$name', '$country')";
        if(mysqli_query($connection, $insert)){
            $message =  "Records added successfully.";
        } 
            else
        {
            $message = "ERROR: Could not able to execute $insert. " . mysqli_error($connection);
        }
        
        // Close connection
        mysqli_close($connection);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>
  
    <div class="container-fluid h-100 bg-light text-dark">
        <div class="row justify-content-center align-items-center">
            <h1>Select Option Dynamic Mysql</h1>    
        </div>
        <hr/>
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <h5 class="text-success text-center" id="message"><?= $message; ?><h5>
                <form action="index.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <select class="form-control" name="country">
                        <option>Please select country</option>
                        <?php foreach($result as $key => $value){ ?>
                          <option value="<?= $value['country'];?>"><?= $value['country']; ?></option> 
                        <?php } ?>
                    </select>
                </div>
              <div class="form-group">
                <div class="container">
                  <div class="row">
                    <div class="col"><button type="submit" name="submit" class="col-6 btn btn-primary btn-sm float-left">Submit</button></div>
                    <div class="col"><button type="submit" name="reset" class="col-6 btn btn-secondary btn-sm float-right">Reset</button></div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function()
        {
            setTimeout(function()
            {
                $('#message').hide();
            },3000);
        });
    </script>
</body>

</html>