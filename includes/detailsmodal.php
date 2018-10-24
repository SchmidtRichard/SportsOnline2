<?php

  //  require_once 'system/init.php';
  set_include_path('/system.init.php');


  if(isset($_POST['id'])){
    $id = $_POST['id'];

    //For security reasons we cast it to an integer to make sure it not any other data to be passed to our post
    $id = (int)$id;
    $sql = "SELECT * FROM products WHERE id = '$id'";




    $db = mysqli_connect('127.0.0.1','cms_www','7QMzcSgF2svJMcTk','sports_online');

    if(mysqli_connect_error()){
      echo 'Database connection failed, check the error: ' . mysqli_connect_error();
      die();
    }




    //Execute the query
    $result = $db->query($sql);

    //PHP function that takes the result of our query and turn it into an associative array and set that to $product (associative array)
    $product = mysqli_fetch_assoc($result);

    $brand_id = $product['brand'];
    $sql = "SELECT brand FROM brand WHERE id = '$brand_id'";

    //Run the query
    $brand_query = $db->query($sql);
    $brand = mysqli_fetch_assoc($brand_query);

    $sizestring = $product['sizes'];

    //Separate the size and quantity - use php function explode that will take the string and make a new array from string and split everytime it sees a come it make a new array
    $size_array = explode(',', $sizestring);

  }

?>



<!-- php function that starts a buffer that reads all the code below and add to the buffer and send it back the AJAX request as the DATA object and when it gets to be bottom it will free the memory (cleans the buffer) with the ob_get_clean(); function -->
<?php ob_start(); ?>

<!-- Details Modal - Light Box -->
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
  <!-- Large modal -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" onclick="closeModal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-center"><?= $product['title']; ?></h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <div class="center-block">
                <img src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" class="details img-responsive"> <!-- Bootstrap class that makes image responsive -->
              </div>
            </div>
            <div class="col-sm-6">
              <h4>Details</h4>
              <p><?= $product['description']; ?></p>
              <!-- Horizontal Row -->
              <hr>
              <p>Price: €<?= $product['price']; ?></p>
              <p>Brand: <?= $brand['brand']; ?></p>
              <form action="add_cart.php" method="post">
                <div class="form-group">
                  <!-- Adds an input inside the div below and give a class with a column to control its size -->
                  <div class="col-xs-3">
                    <label for="quantity">Quantity:</label>
                    <input type="text" class="form-control" id="quantity" name="quantity">
                  </div>
                  <div class="col-xs-9"></div>
                </div>
                <div class="form-group">
                  <label for="size">Size:</label>

                  <select name="size" id="size" class="form-control">
                    <option value=""></option>

                    <?php foreach($size_array as $string){
                      $string_array = explode(':', $string);
                      $size = $string_array[0];
                      $quantity = $string_array[1];
                      echo '<option value="'.$size.'">'.$size.' ('.$quantity.' Available)</option>';
                    }?>

                  </select>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" onclick="closeModal()">Close</button>

        <!-- Bootstrap glyphs from the Glyphicon Halflings set to add the cart icon -->
        <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Basket</button>
      </div>
    </div>
  </div>
</div>


<script>
  function closeModal(){
    jQuery('#details-modal').modal('hide');
    setTimeout(function(){
      jQuery('#details-modal').remove();//Removes details modal
      jQuery('.modal-backdrop').remove();//Removes the black background
    },500);
  }
</script>















<?php echo ob_get_clean(); ?>
