<?php
require_once '../../lib/User.php';

$id = $_POST['id'];
$category = User::getCategoryProducts($id);

$html = '
<div class="modal fade modal-add-edit-category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">ID: '.$id.'</h4>
      </div>
      <div class="modal-body">
        <div class="row">
<div id="test"></div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
              <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="form-group">
                  <label for="categoryname">Category Name</label>
                  <input id="categoryname" type="text" class="form-control" placeholder="Category Name" value="'.$category->categoryname.'">
                </div>
                <div class="form-group">
                  <label for="ctime">Created</label>
                  <input disabled id="ctime" type="text" class="form-control" placeholder="Created" value="'.$category->ctime.'">
                </div>
                <div class="form-group">
                  <label for="mtime">Modified</label>
                  <input disabled id="mtime" type="text" class="form-control" placeholder="Modified" value="'.$category->mtime.'">
                </div>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">';
if ($category->img !== null) {
    $img = User::getImage($category->img);
    $html .= '<img src="'.User::replaceImg($img->imagename).'" alt="'.$img->imagename.'">';
} else {
    $html .= '<img src="" width="250" height="250" alt="Image">';
}
$html .=         '<input id="input_image" type="file">
                </div>
              </div>
            </div>
            </div>
            </div>
            <div class="modal-footer">
        <div class="row">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_delete_category" type="button" class="btn btn-danger" data-id="'.$id.'">Delete</button>
                    <button id="btn_edit_category" type="button" class="btn btn-primary" data-id="'.$id.'">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
';
echo $html;