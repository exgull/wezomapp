<?php
require_once '../../lib/User.php';

$categories = User::getCategoryProductsAll();

//object(CategoryProducts)#4 (8) {
//      ["id"]=> string(1) "1"
//      ["categoryname"]=> string(3) "Car"
//      ["img"]=> string(1) "3"
//      ["ctime"]=> string(10) "2016-10-08"
//      ["mtime"]=> string(10) "2016-10-08"

$html = '<thead>
            <tr>
                <th width="10%">Id</th>
                <th width="70%">Name</th>
                <th width="10%">Created</th>
                <th width="10%">Modified</th>
            </tr>
        </thead>
        <tbody>';

foreach ($categories as $category) {
    $html .= '<tr class="addmodal" data-id="'.$category->id.'" data-type="edit-category">
            <td>'.$category->id.'</td>
            <td class="change_value categoryname">'.$category->categoryname.'</td>
            <td class="change_value ctime">'.$category->ctime.'</td>
            <td class="change_value mtime">'.$category->mtime.'</td>
          </tr>';
}
$html .= '<tr>
            <td></td>
            <td></td>
            <td></td>
            <td><button type="button" class="addmodal btn btn-primary" data-toggle="modal" data-target=".modal-add-category" data-id="" data-type="category">Add New</button></td>
          </tr>
      </tbody>';
echo $html;