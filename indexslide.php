<style type="text/css">
                            .carousel {
                                height: 293px;
                                background: #a7a7a7ee;
                            }
                        </style>
                        <?php
                         $slides = $model->getAllActiveSlides();
                        ?>
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <?php foreach($slides as $idx => $s): ?>

                            <li data-target="#carouselExampleCaptions" data-slide-to="<?= $idx;?>" class="<?=($idx==0) ? 'active' : ''; ?>""></li>
                            <?php endforeach ?>
                          </ol>
                          <div class="carousel-inner">
                            <?php foreach($slides as $idx => $s): ?>
                            <div class="carousel-item img-fluid <?=($idx==0) ? 'active' : ''; ?>">
                                <figure style="background:url(<?= $s['photo'];?>);width: 100%; height: 290px; background-size: 100%; margin: 0; padding: 0; background-position: top center;background-repeat: no-repeat;"></figure>
                            </div>
                            <?php endforeach ?>
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
