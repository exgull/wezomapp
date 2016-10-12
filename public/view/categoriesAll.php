<ol class="breadcrumb">
    <li class="active"><a href="/wezom/">Home</a></li>
</ol>
<div class="container">
    <div id="global" class="row">
<?php

foreach ($categories as $category) {
//    var_dump($category);
    $html  = '<div class="col-sm-6 col-md-4">
                <div class="thumbnail">';
//                    <a href="/wezom/wezom/c'.$category->id.'">

//    if ($category->img !== null) {
//        $img = User::getImage($category->img);
//        $html .= '<img src="/wezom/public/image/'.$img->imagename.'" width="250" height="250" alt="'.$category->categoryname.'">';
//    } else {
//        $html .= '<img src="" width="250" height="250" alt="'.$category->categoryname.'">';
//    }

//    </a>
    $html .=       '
                    <div class="caption">
                        <a href="/wezom/wezom/c'.$category->id.'"><h3 align="center">'.$category->categoryname.'</h3></a>
                    </div>
                </div>
            </div>';
    echo $html;

}

?>
    </div>
</div>

