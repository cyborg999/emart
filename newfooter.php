        <footer class="section-footer border-top">
            <div class="container">
                <section class="footer-top padding-y">
                    <div class="row">
                         <?php
                            $setting = $model->getAdminSetting(true);
                        ?>
                        <aside class="col-sm-6">
                            <article class="mr-3">
                                <figure id="logo" class="logo-footer"></figure>
                                <p class="mt-3"><?= ($setting) ? $setting['overview'] : ''; ?></p>
                                <div>
                                    <?php
                                      $social = $model->getAllSocialMedia();
                                    ?>
                                  <ul class="nav mr-auto d-none d-md-flex">
                                    <?php foreach($social as $idx => $s): ?>
                                        <li><a href="<?= $s['link'];?>" class="nav-link px-2"> <i class="fa fa-<?= $s['social'];?>"></i> </a></li>
                                      <?php endforeach ?>
                                  </ul>

                                </div>
                            </article>
                        </aside>
                        <aside class="col-sm-3">
                            <h4 style="padding:0;">Useful Links</h4>
                            <ul style="padding:0;">
                              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
                              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=about" target="_blank">About us</a></li>
                              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=terms" target="_blank">Terms of service</a></li>
                              <li><i class="bx bx-chevron-right"></i> <a href="footer.php?page=privacy" target="_blank">Privacy policy</a></li>
                            </ul>
                        </aside>
                        <aside class="col-sm-3">
                            <h4>Contact Us</h4>
            
                            <?= ($setting) ? $setting['contact'] : ''; ?>
                            <div class="text-md-left tesxt-muted">
                                        <i class="fa fa-lg fa-cc-visa"></i>
                                        <i class="fa fa-lg fa-cc-paypal"></i>
                                        <i class="fa fa-lg fa-cc-mastercard"></i>
                                    </div>
                        </aside>
                    </div> <!-- row.// -->
                </section>  <!-- footer-top.// -->
            </div><!-- //container -->
        </footer>