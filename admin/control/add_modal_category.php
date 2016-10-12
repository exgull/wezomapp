<?php
$html = '<div class="modal fade modal-add-category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="gridSystemModalLabel">Add New Category</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div id="divaddcategory"></div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="newcategoryname">Categoryname Name</label>
                                <input id="newcategoryname" type="text" class="form-control" placeholder="Categoryname Name"">
                            </div>
                        </div>
					</div>
					<div class="modal-footer">
						<div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input id="input_image" name="input_image" type="file">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="btn_add_category" type="button" class="btn btn-primary">Add</button>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
';
echo $html;