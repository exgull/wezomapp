<?php
$category = User::getCategoryProducts($id);
?>
<ol class="breadcrumb">
    <li><a href="/wezom/">Home</a></li>
    <li class="active"><a href="/wezom/wezom/c<?php echo $category->id ?>"><?php echo $category->categoryname ?></a></li>
</ol>
<div class="container">
    <div id="global" class="row">

<?php

foreach ($productsByCategory as $product) {
    echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                <div class="panel-body"><a href="/wezom/wezom/p'.$product->id.'">';
    print_r ($product);
    echo '</a></div></div></div>';
//    $html  = '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
//                <div class="panel panel-default">
//                <div class="panel-body">
//                    <div class="row">
//                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
//                            <div class="thumbnail">';

//if ($product->img !== null) {
//        $img = User::getImage($product->img);
//        $html .= '<img src="/wezom/public/image/'.$img->imagename.'" width="250" height="250" alt="'.$category->categoryname.'">';
//    } else {
//        $html .= '<img src="" width="250" height="250" alt="'.$product->categoryname.'">';
//    }

//    $html .= '</div>
//                </div>
//                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
//                    <div class="row">
//                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-9">
//                            <div class="caption">
//                                <a href="/wezom/wezom/p'.$product->id.'"><h3>'.$product->productname.'</h3></a>
//                            </div>
//                        </div>
//                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
//                        	<div class="caption">
//                        	    <h3>'.$product->price.'</h3>
//                        	</div>
//                        </div>
//                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
//                        	<p>'.$product->description.'</p>
//                        </div>
//                    </div>
//                </div>
//            </div>
//        </div>
//    </div></div>';
//    echo $html;
}

    ?>
    </div>
</div>