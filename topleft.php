<div class="menu-widget">
    <p>All Categories</p>
    <?php 
        $categories = $model->getAllActiveCategories();
    ?>
    <ul class="list-unstyled">
       <?php foreach($categories as $idx => $c): ?>
        <li><a href="filtered.php?category=<?= $c['id'];?>"><img src="./index_files/w-cloath.png" alt=""><?= $c['name'];?></a>
           
        </li>
        <?php endforeach ?>
        
    </ul>
</div>