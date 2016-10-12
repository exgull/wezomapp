<?php
$categories = User::getCategoryAllByProduct($product);
?>
<ol class="breadcrumb">
    <li><a href="/wezom/">Home</a></li>

    <?php
    if (count($categories) > 0) {
        echo '<li>';
        foreach ($categories as $category) {
            echo '<a href="/wezom/wezom/c'.$category->id.'">'.$category->categoryname.'</a> ';
        }
        echo '</li>';
    }
    ?>
    <li class="active"><a href="/wezom/wezom/p<?php echo $product->id ?>"><?php echo $product->productname ?></a></li>
</ol>
<div class="container">
    <div id="global" class="row">
        <?php
        echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                <div class="panel-body"><a href="/wezom/wezom/p'.$product->id.'">';
        print_r ($product);
        echo '</a></div></div></div>';

        ?>
    </div>
</div>