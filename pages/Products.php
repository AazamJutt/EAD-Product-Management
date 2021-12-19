<?php
  include('../conn.php');
  session_start();
  if(isset($_SESSION["name"])){
    header("Location: ../AdminHome.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Products</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="../jquery.js"></script>
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
<?php
      if(isset($_REQUEST["login"])){
        //Clear all sessions
        session_destroy();
        header('Location: ./SignIn.php');
      }
    ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="./Products.php">Products Site</a>
          <a class="navbar-toggler" type="a" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            <li class="nav-item">
                <a class="nav-link active" href="./Products.php">Products</a>
              </li>
            </ul>
          </div>
        </div>
        <form>
          <button id="login" name="login" type="submit" class="btn btn-outline-danger my-2 my-sm-0 custom-btn">Admin Login</button>      
        </form>
      </nav>
  <div class="container">
    <div class="h2 p-3">All Products</div>
    <div class="border rounded-pill border"></div>
  </div>
  <div class="container mb-5">
    <div class="row">
    <?php

        $sql = "SELECT  product.PicURL,product.Name,
                        type.TypeName,
                        product.Price,product.Description
                FROM product 
                INNER JOIN type ON type.TypeId = product.TypeId 
                WHERE product.IsActive = true;";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {                  
          while($row = mysqli_fetch_assoc($result)) {
            
            $picture = $row["PicURL"];
            $name = $row["Name"];
            $type = $row["TypeName"];
            $price = $row["Price"];
            $dummy = $price+1000;
            $desc = $row["Description"];
            echo "
            <div class='col-md-4 mb-1 mt-1'>
              <div class='card mt-3 shadow border-0'>
                <div class='align-items-center p-2 text-center'>
                  <div class='px-0'>
                    <img src='../img/$picture' class='rounded' width='200' />
                  </div>
                    <figcaption>
                      <h4 class='mt-2'>$name</h4>

                      <div class='align-items-center'>
                        <h5 class='d-inline'>Rs.$price</h5>
                        <del class='text-danger'>Rs.$dummy</del>
                      </div>
                      <p class='card-text'>Type: $type</p>
                      <p class='card-text'>Description: $desc</p>
                    </figcaption>
                    <div class='dropdown-divider'></div>
                    <div>
                      <button id='addToCart' class='btn btn-outline-primary custom-btn'>Add to Cart</button>
                    </div>
                </div>
              </div>
            </div>";                  
        }				
      } 
    ?>
    </div>
  </div>
</body>

</html>