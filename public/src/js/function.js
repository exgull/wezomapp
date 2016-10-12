/**
 * Created by gull on 08.10.16.
 */
function addModal(type, id) {
    $.ajax({
        url:"control/add_modal_"+type+".php",
        method:"POST",
        data:{id:id},
        success:function(data) {
            $('#add_modal').html(data);
            $('.modal-add-'+type).modal('show');
        }
    });
}
function getProduct() {
    $.ajax({
        url:"control/select_product.php",
        method:"POST",
        success:function(data) {
            $('#contents').html(data);
            $('#add_modal').html('');
            $('.modal-backdrop').remove();
        }
    });
}
function addProduct(fdata) {
    $.ajax({
        url:"control/insert_product.php",
        data: fdata,
        processData: false,
        contentType: false,
        type:"POST",
        success:function(data){
            // $('#divaddproduct').html(data);
            $('.modal-add-product').modal('hide');
            getProduct();
        }
    });
}
function removeProduct(id) {
    $.ajax({
        url:"control/delete_product.php",
        method:"POST",
        data:{id:id},
        dataType:"text",
        success:function(data){
            $('.modal-add-edit-product').modal('hide');
            getProduct();
        }
    });
}
function editProduct(fdata) {
    $.ajax({
        url:"control/update_product.php",
        data: fdata,
        processData: false,
        contentType: false,
        type:"POST",
        success:function(data){
            // $('#test').html(data);
            $('.modal-add-edit-product').modal('hide');
            getProduct();
        }
    });
}
function getCategory() {
    $.ajax({
        url:"control/select_category.php",
        method:"POST",
        success:function(data) {
            $('#add_modal').html('');
            $('#contents').html(data);
            $('.modal-backdrop').remove();
        }
    });
}
function addCategory(fdata) {
    $.ajax({
        url:"control/insert_category.php",
        data: fdata,
        processData: false,
        contentType: false,
        type:"POST",
        success:function(data){
            // $('#divaddcategory').html(data);
            $('.modal-add-category').modal('hide');
            getCategory();
        }
    });
}
function removeCategory(id) {
    $.ajax({
        url:"control/delete_category.php",
        method:"POST",
        data:{id:id},
        dataType:"text",
        success:function(data){
            $('.modal-add-edit-category').modal('hide');
            getCategory();
        }
    });
}
function editCategory(fdata) {
    $.ajax({
        url:"control/update_category.php",
        data: fdata,
        processData: false,
        contentType: false,
        type:"POST",
        success:function(data){
            // $('#test').html(data);
            $('.modal-add-edit-category').modal('hide');
            getCategory();
        }
    });
}