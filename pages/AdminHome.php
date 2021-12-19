<?php
  session_start();
  if(!isset($_SESSION["name"])){
    header("Location: ./SignIn.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="../jquery.js"></script>
    <script type="text/javascript">
    </script>
    <title>Admin Home</title>
  </head>
  <body>
    <?php
      if(isset($_REQUEST["logout"])){
        //Clear all sessions
        session_destroy();
        header('Location: ./SignIn.php');
      }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Admin</a>
          <a class="navbar-toggler" type="a" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            <li class="nav-item">
                <a class="nav-link active">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./AddNewProduct.php">Add Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./AdminProductView.php">View Product</a>
              </li>
            </ul>
          </div>
        </div>
        <form>
        <button id="logout" name="logout" type="submit" class="btn btn-outline-danger my-2 my-sm-0">Logout</button>      
        </form>
      </nav>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 600px; max-width: 600px;">
     <div>
        <div class="text-center mb-4">
            <h1>Welcome <?php echo isset($_SESSION["name"])?$_SESSION["name"]:'Admin'?></h1>
          </div>
          <a class="btn btn-lg btn-outline-danger" href="AddNewProduct.php">Add New Product</a>
          <a class="btn btn-lg btn-outline-danger" href="AdminProductView.php">View Product</a>
     </div>
    </div>
  </body>
</html>
