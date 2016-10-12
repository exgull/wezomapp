/**
 * Created by gull on 08.10.16.
 */
$(document).ready(function(){
    $(document).on('click', '#getProduct', function(){
        getProduct();
        $('#getCategory').removeClass('active');
        $(this).addClass('active');
    });
    $(document).on('click', '#btn_add_product', function(){
        var productname = $('#newproductname').val();
        var description = $('#newdescription').val();
        var price = $('#newprice').val();
        var spacial_price = $('#newspacial_price').val();
        var categories=[];
        $(".btn-success").each(function() {
            categories.push($(this).data("id"));
        });
        var $input = $('#input_image');
        var fdata = new FormData();
        fdata.append('file', $input.prop('files')[0]);
        fdata.append('productname', productname);
        fdata.append('description', description);
        fdata.append('price', price);
        fdata.append('spacial_price', spacial_price);
        fdata.append('categories', categories);
        if (productname == '') {
            alert("Enter Product Name");
            return false;
        }
        if (description == '') {
            alert("Enter Description");
            return false;
        }
        if (price == '') {
            alert("Enter Price");
            return false;
        }
        addProduct(fdata);
    });
    $(document).on('click', '#btn_delete_product', function(){
        var id=$(this).data("id");
        if(confirm("Are you sure you want to delete this?")){
            removeProduct(id);
        }
    });
    $(document).on('click', '#btn_edit_product', function(){
        if(confirm("Are you sure you want to edit this?")){
            var id=$(this).data("id");
            var productname = $('#productname').val();
            var description = $('#description').val();
            var price = $('#price').val();
            var spacial_price = $('#spacial_price').val();
            var categories=[];
            $(".btn-success").each(function() {
                categories.push($(this).data("id"));
            });
            var $input = $('#input_image');
            var fdata = new FormData();
            fdata.append('file', $input.prop('files')[0]);
            fdata.append('id', id);
            fdata.append('productname', productname);
            fdata.append('description', description);
            fdata.append('price', price);
            fdata.append('spacial_price', spacial_price);
            fdata.append('categories', categories);

            editProduct(fdata);
        }
    });
    $(document).on('click', '#getCategory', function(){
        getCategory();
        $('#getProduct').removeClass('active');
        $(this).addClass('active');
    });
    $(document).on('click', '#btn_add_category', function(){
        var categoryname = $('#newcategoryname').val();
        var $input = $('#input_image');
        var fdata = new FormData();
        fdata.append('file', $input.prop('files')[0]);
        fdata.append('categoryname', categoryname);
        if (categoryname == '') {
            alert("Enter category Name");
            return false;
        }
        addCategory(fdata);
    });
    $(document).on('click', '#btn_delete_category', function(){
        var id=$(this).data("id");
        if(confirm("Are you sure you want to delete this?")){
            removeCategory(id);
        }
    });
    $(document).on('click', '#btn_edit_category', function(){
        if(confirm("Are you sure you want to edit this?")){
            var id=$(this).data("id");
            var categoryname = $('#categoryname').val();
            var $input = $('#input_image');
            var fdata = new FormData();
            fdata.append('file', $input.prop('files')[0]);
            fdata.append('id', id);
            fdata.append('categoryname', categoryname);

            editCategory(fdata);
        }
    });
    $(document).on('click', '.addmodal', function(){
        var id = $(this).data('id');
        var type = $(this).data('type');
        addModal(type, id);
    });
    $(document).on('click', '.btn-category', function(){
        if($(this).hasClass('btn-success')) {
            $(this).removeClass('btn-success');
        } else {
            $(this).addClass('btn-success');
        }
    });
});