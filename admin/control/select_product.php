<?php
require_once '../../lib/User.php';

$products = User::getProductAll();

//object(Product)#4 (8) {
//      ["id"]=> string(1) "1"
//      ["productname"]=> string(3) "Car"
//      ["description"]=> string(3) "toy"
//      ["img"]=> string(0) ""
//      ["price"]=> string(3) "100"
//      ["spacial_price"]=> NULL
//      ["ctime"]=> string(10) "2016-10-08"
//      ["mtime"]=> string(10) "2016-10-08"

$html = '<thead>
            <tr>
                <th width="10%">Id</th>
                <th width="30%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Spacial Price</th>
                <th width="10%">Created</th>
                <th width="10%">Modified</th>
            </tr>
        </thead>
        <tbody>';

foreach ($products as $product) {
    $html .= '<tr class="addmodal" data-id="'.$product->id.'" data-type="edit-product">
            <td>'.$product->id.'</td>
            <td class="change_value productname">'.$product->productname.'</td>
            <td class="change_value price">'.$product->price.'</td>
            <td class="change_value spacial_price">'.$product->spacial_price.'</td>
            <td class="change_value ctime">'.$product->ctime.'</td>
            <td class="change_value mtime">'.$product->mtime.'</td>
          </tr>';
}
$html .= '<tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><button type="button" class="addmodal btn btn-primary" data-toggle="modal" data-target=".modal-add-product" data-id="" data-type="product">Add New</button></td>
          </tr>
      </tbody>';
echo $html;