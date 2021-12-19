<?php
  include('../conn.php');
  session_start();
  if(!isset($_SESSION["name"])){
    header("Location: ../SignIn.php");
  }
  if(!isset($_SESSION['productId'])){
    header("Location: ./AdminProductView.php");
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
    <title>Document</title>
  </head>
  <body>
  <?php
      if(isset($_REQUEST["logout"])){
        //Clear all sessions
        session_destroy();
        header('Location: ./SignIn.php');
        die;
      }
      if(isset($_SESSION["productId"])){
        $id = $_SESSION["productId"];
        $sql = "SELECT * FROM product WHERE productId='$id'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          
                $_SESSION["prod_name"] = $row["Name"];
                $_SESSION["prod_type"] = $row["TypeId"];
                $_SESSION["prod_price"] = $row["Price"];
                $_SESSION["prod_desc"] = $row["Description"];
                $_SESSION["prod_pic"] = $row["PicURL"];
        } 
      }
      if(isset($_REQUEST["btnUpdate"])){
        $name = $_REQUEST["name"];
        $price  = $_REQUEST["price"];
        $type = $_REQUEST["type"];
        $desc = $_REQUEST["desc"];

        //Here 'userpic' is name of your 'file control'
        //explore will break the name by using '.' delimeter.
        $temp = explode(".", $_FILES["picture"]["name"]);
        
        //Create a unique name by using time and append the actual extension
        $new_name = round(microtime(true)) . '.' . end($temp);
        
        //save file into "img" folder with the name stored '$new_name' variable
        move_uploaded_file($_FILES["picture"]["tmp_name"], "../img//".$new_name);

        $date = date_create()->format('Y-m-d H:i:s');
        $admin = $_SESSION["id"];
        $prodId = $_SESSION["productId"];
        //store image name in database
        $query="UPDATE `product` 
                SET `Name`='$name', 
                    `TypeId`='$type',
                    `Price`='$price',
                    `Description`='$desc', 
                    `PicURL`='$new_name', 
                    `UpdatedOn`='$date', 
                    `UpdatedBy`='$admin' 
                WHERE `ProductId`='$prodId';";
        $sql = mysqli_query($conn, $query);
        if(!$sql){
          echo "data not updated";
          echo "Error: ". mysqli_error($conn);
          die;
        }
        else{
            unset($_SESSION["prod_name"]);
            unset($_SESSION["prod_type"]);
            unset($_SESSION["prod_price"]);
            unset($_SESSION["prod_desc"]);
            unset($_SESSION["prod_pic"]);
            header("Location: ./AdminProductView.php");
        }
      }
    ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="AdminHome.php">Admin</a>
          <a class="navbar-toggler" type="a" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            <li class="nav-item">
                <a class="nav-link" href="AdminHome.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./AddNewProduct.php">Add Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./AdminProductView.php">View Product</a>
              </li>
            </ul>
          </div>
        </div>
        <form method="post" enctype="multipart/form-data" >
        <button id="logout" name="logout" type="submit" class="btn btn-outline-danger my-2 my-sm-0">Logout</button>      
        </form>
      </nav>
    <div
      class="d-flex justify-content-center align-items-center"
      style="min-height: 650px"
    >
      <div class="my-2" style="max-width: 400px;">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="card rounded border-danger shadow-lg">
            <div
              class="bg-danger text-white p-2"
              style="border-radius: 2px 2px 0px 0px"
            >
              <h4 class="ml-3">Edit Product</h4>
            </div>
            <div class="p-4">
              <div>
                <label for="basic-url" class="form-label">Name</label>
                <div class="input-group mb-2">
                  <input
                    type="text"
                    class="form-control"
                    id = "name"
                    name = "name"
                    aria-describedby="basic-addon3"
                    value = <?php echo $_SESSION["prod_name"]?>
                    required
                  />
                </div>
                <label for="basic-url" class="form-label">Price</label>
                <div class="input-group mb-2">
                  <input
                    type="text"
                    class="form-control"
                    id = "price"
                    name = "price"
                    aria-describedby="basic-addon3"
                    value = <?php echo $_SESSION["prod_price"]?>
                    required
                  />
                </div>
              </div>
              <label for="basic-url" class="form-label">Type</label>
              <div class="input-group mb-2">
                <select 
                    class="col-12 form-control" 
                    id="type" 
                    name="type" 
                    required>
                  <option selected value="">-- Select --</option>
                  <?php    
                    $sql = "SELECT * FROM type";
                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        $id = $row["TypeId"];
                        $type = $row["TypeName"];
                        echo "<option value='$id'" ;
                        if($_SESSION["prod_type"] == $id){
                            echo ' selected="selected"';
                        }
                        echo ">$type</option>";
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="mb-2">
                <label for="exampleFormControlTextarea1" class="form-label"
                  >Description</label
                >
                <textarea 
                    class="form-control" 
                    id="desc" 
                    name ="desc" 
                    rows="2"
                    required><?php echo $_SESSION["prod_desc"]?></textarea>
              </div>
              <div class="mb-2">
                <label for="formFileMultiple" class="form-label">Picture</label>
                <div class="d-flex justify-content-center">
                  <?php echo '<img src="../img/'.$_SESSION['prod_pic'].'" class="rounded" width="200" />' ?>
                </div>
                <input
                  class="form-control"
                  type="file"
                  name = "picture"
                  id="picture"
                />
              </div>
              <div class="d-flex justify-content-center d-grid my-2">
                <button type="submit" class="btn btn-danger" name="btnUpdate" id="btnUpdate">Update Product</button>
              </div>
            </div>
          </div>
        </form>
        
      </div>
    </div>
  </body>
</html>
