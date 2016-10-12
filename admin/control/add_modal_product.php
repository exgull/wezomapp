<?php
$html = '<div class="modal fade modal-add-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="gridSystemModalLabel">Add New Product</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div id="divaddproduct"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="newproductname">Product Name</label>
                            <input id="newproductname" type="text" class="form-control" placeholder="Product Name"">
                        </div>
                        <div class="form-group">
                            <label for="newprice">Price</label>
                            <input id="newprice" type="text" class="form-control" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="newspacial_price">Special Price</label>
                            <input id="newspacial_price" type="text" class="form-control" placeholder="Special Price">
                        </div>
                        <div class="form-group">
                            <label for="newdescription">Description</label>
                            <textarea id="newdescription" class="form-control" placeholder="Description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label><br>';
	require_once '../../lib/User.php';
	$categories = User::getCategoryProductsAll();
	foreach ($categories as $category) {
		$html .= '<button class="btn-category btn-sm btn btn-default" type="submit" data-id="'.$category->id.'">'.$category->categoryname.'</button> ';
	}
$html .=	'</div></div></div>
				<div class="modal-footer">
					<div class="row">
					    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					    	<input id="input_image" name="input_image" type="file">
					    </div>
					    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="btn_add_product" type="button" class="btn btn-primary">Add</button>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
';
echo $html;