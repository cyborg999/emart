<!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
    <?php
    $setting = $model->getAdminSetting(true);
    ?>


    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=about" target="_blank">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=terms" target="_blank">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=privacy" target="_blank">Privacy policy</a></li>
            </ul>
          </div>


          <div class="col-lg-4 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            
            <?= ($setting) ? $setting['contact'] : ''; ?>
          </div>

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>BakedPH Overview</h3>
            <p><?= ($setting) ? $setting['overview'] : ''; ?></p>
            <?php
              $social = $model->getAllSocialMedia();
            ?>
            <div class="social-links mt-3">
              <?php foreach($social as $idx => $s): ?>
                <a href="<?= $s['link'];?>" target="_blank" class="<?= $s['social'];?>"><i class="bx bxl-<?= $s['social'];?>"></i></a>
              <?php endforeach ?>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>BakedPH</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->



<!-- Modal -->
<div class="modal fade" id="editProductModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row  ">
          <div class="col-sm msg hidden"></div>
        </div>
        <div class="row">

          <div class="col-sm">
            <h5>Material Information</h5>
            <form method="post" id="editform">
            <div class="row">
              <div class="col-sm-6">
                <input type="hidden" name="editmaterial" id="editid" value="">
                  <div class="form-group">
                    <label>Name :
                      <input type="text" id="editname" required class="form-control" name="name" value="" placeholder="Material Name..."/>
                    </label>
                  </div>
                  <div class="form-group hidden">
                    <label>Price:
                      <input type="text" id="editprice" required class="form-control" name="price" placeholder="Price..."/>
                    </label>
                  </div>
                  <div class="form-group">
                    <label>Unit:
                      <input type="text" id="editunit" required class="form-control" name="unit" placeholder="Unit..."/>
                    </label>
                  </div>
              </div>
              <div class="col-sm-6 ">
                <div class="form-group">
                  <label>Quantity:
                    <input type="number" readonly id="editqty"  class="form-control" name="qty" placeholder="Quantity..."/>
                  </label>
                </div>
                <div class="form-group hidden">
                  <label>Expiry Date:
                    <input type="date" id="editexpiry" required class="form-control" name="expiry" placeholder="Expiry Date..."/>
                  </label>
                </div>
                <input type="submit" class="btn btn-lg btn-success" value="Update">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
