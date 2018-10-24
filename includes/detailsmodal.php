<?php



  require_once '../system/init.php'

  $id = $_POST['id'];
  //For security reasons we cast it to an integer to make sure it not any other data to be passed to our post
  $id = (int)$id;
  $sql = "SELECT * FROM products WHERE id = '$id'";

  //Execute the query
  $result = $db->query($sql);

  //PHP function that takes the result of our query and turn it into an associative array and set that to $product (associative array)
  $product = mysqli_fetch_assoc($result);
?>



<?php ob_start(); ?><!-- php function that starts a buffer that reads all the code below and add to the buffer and send it back the AJAX request as the DATA object and when it gets to be bottom it will free the memory (cleans the buffer) with the ob_get_clean(); function -->

<!-- Details Modal - Light Box -->
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
  <!-- Large modal -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
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
              <p><?= $product['description'];?></p>
              <!-- Horizontal Row -->
              <hr>
              <p>Price: €<?=$product['price'];?></p>
              <p>Brand: Nike</p>
              <form action="add_basket.php" method="post">
                <div class="form-group">
                  <!-- Adds an input inside the div below and give a class with a column to control the its size -->
                  <div class="col-xs-3">
                    <label for="quantity">Quantity:</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="">
                  </div>
                  <div class="col-xs-9"></div>
                  <p>Available: 3</p>
                </div><br><br>
                <div class="form-group">
                  <label for="size">Size:</label>
                  <select class="form-control" name="size" id="size">
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>

        <!-- Bootstrap glyphs from the Glyphicon Halflings set to add the cart icon -->
        <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Basket</button>
      </div>
    </div>
  </div>
</div>

<?php echo ob_get_clean(); ?>
