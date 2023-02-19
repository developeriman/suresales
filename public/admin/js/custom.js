// Image Field Show
$(document).ready(function () {
    $(".btn-success").click(function () {
        var lsthmtl = $(".clone").html();
        $(".increment").after(lsthmtl);
    });
    $("body").on("click", ".btn-danger", function () {
        $(this).parents(".hdtuto").remove();
    });
});

// Gallery image hover
$(".img-wrapper").hover(
    function () {
    $(this).find(".img-overlay").animate({ opacity: 1 }, 600);
    },
    function () {
    $(this).find(".img-overlay").animate({ opacity: 0 }, 600);
    }
);

//Gallery Image Delete
function galleryImageDelete(id, product_id) {
    $.ajax({
        url: "/admin/product-image-gallery/delete",
        type: "POST",
        data: { id: id, product_id: product_id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (result) {
            $("#product_gallery").html(result);
        },
    });
}

//----- set value for click button -----//
function setValueForClickModal(id){
    $('#product-click-modal-btn').data('product_id',id);
}

//----- Make product click value 0 -----//
$(document).on("click","#product-click-modal-btn",function(){
    let id = $("#product-click-modal-btn").data("product_id");
    $.ajax({
        type: "GET",
        url: "/admin/product-click-change/" + id,
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( response = "success" ){
                if( response = "success" ){
                    toastr.info(
                        'Click become 0.','',
                      {
                        timeOut: 1000,
                        fadeOut: 1000,
                        onHidden: function () {
                          window.location.reload();
                       }
                     });
                }
            }
        }
    })
})


function getCategoryValue(id){
    $.ajax({
        type:'POST',
        url:'/admin/product/sub-category-value',
        data:{id:id},
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success:function(data){
            $('#sub-category').html(data);
            $('#sub-category').show();
        }
        
    });
}

//----- set value for member delete button -----//
function setValueForMemberDeleteModal(id){
    $('#member-delete-modal-btn').data('id',id);
}

//----- Member delete -----//
$(document).on("click","#member-delete-modal-btn",function(){
    let id = $("#member-delete-modal-btn").data("id");
    $.ajax({
        type: "GET",
        url: "/admin/member-delete/" + id,
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( response = "success" ){
                toastr.info(
                    'Member deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                });
            }
        }
    })
})

//----- set value for member approve button -----//
$(function () {
    $(".toggle-class").change(function () {
        var approve = $(this).prop("checked") == true ? 1 : 0;
        var id = $(this).data("id");
        
        // here when we click checkbox it become selected first thats why we are getting value in reverse way
        // thats why we will assume value in reverse way
        if(approve == 0){
            $('#member-approve-modal-body').html("Sure to Delete Level C?");
        }else{
            $('#member-approve-modal-body').html("Sure to Level C?");
        }
        $('#member-Approve-modal-btn').data('id',id);
        $('#member-Approve-modal-btn').data('approve',approve);
    });
});

//----- Member Approve -----//
$(document).on("click","#member-Approve-modal-btn",function(){
    let id = $("#member-Approve-modal-btn").data("id");
    let approve = $("#member-Approve-modal-btn").data("approve");
    $.ajax({
        type: "GET",
        url: "/admin/member-approve",
        data: { id: id, approve: approve},
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( response = "success" ){
                toastr.info(
                    'Success.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                });
            }
        }
    })
})


jQuery("#addProductForm").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(document.getElementById('addProductForm'));
    jQuery.ajax({
        url: "/admin/product/store",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (result) {
            if (result.status == "error") {
                jQuery.each(result.error, function (key, value) {
                    if(key == 'sub_category'){
                        $('#sub-category').show();
                        jQuery("#" + key + "_error").html(value[0]);
                    }else{
                        jQuery("#" + key + "_error").html(value[0]);
                    }
                    
                });
            }
            if (result.status == "success") {
                window.location.href = '/admin/product/edit/' + result.id;
            }
        },
    });
});

//----- Product Check All Functionality -----//
$("#chk_all").click(function () {
    if ($(this).prop('checked')) {
        $(".chk_child").prop("checked", true);
    } else {
        $(".chk_child").prop("checked", false);
    }
});

//------ Product Authorize modal call ------//
function openAuthorizeModel(){
    $('#productAuthorizeModal').modal('show'); 
}


//----- restrict to level c -----//
$(document).on("click","#product-authorize-restrict",function(){
    let val = $("#product-authorize-restrict").data("val");
    var id = $.map($('input[name="id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/product-authorize-change",
        data: { id: id, val: val},
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Success','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//----- Product restrict to release -----//
$(document).on("click","#product-authorize-release",function(){
    let val = $("#product-authorize-release").data("val");
    var id = $.map($('input[name="id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/product-authorize-change",
        data: { id: id, val: val},
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Success','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//----- Product delete -----//
$(document).on("click","#product-delete",function(){
    var id = $.map($('input[name="id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/product-delete",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Product deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})


//----- Show Contact to frontend -----//
$(function () {
    $(".contact-toggle-class").change(function () {
        var val = $(this).prop("checked") == true ? 0 : 1;
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/admin/contact-approve",
            data: { id: id, val: val },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(result){
                console.log(result);
            }
        })
        
    });
});

//----- Show Contact to frontend -----//
$(function () {
    $(".sitemap-toggle-class").change(function () {
        var val = $(this).prop("checked") == true ? 0 : 1;
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/admin/sitemap-approve",
            data: { id: id, val: val },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(result){
                console.log(result);
            }
        })
        
    });
});

//----- Show Certificate to frontend -----//
$(function () {
    $(".certificate-toggle-class").change(function () {
        var val = $(this).prop("checked") == true ? 0 : 1;
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/admin/certificate-approve",
            data: { id: id, val: val },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(result){
                console.log(result);
            }
        })
        
    });
});

//------ Category trash modal call ------//
function openTrashRecoverModel(){
    $('#trashRecoverModal').modal('show'); 
}

//----- Category Trash Check All Functionality -----//
$("#category_chk_all").click(function () {
    if ($(this).prop('checked')) {
        $(".category_chk_child").prop("checked", true);
    } else {
        $(".category_chk_child").prop("checked", false);
    }
});

//----- Category Trash recover  -----//
$(document).on("click","#trash-recover-btn",function(){
    var id = $.map($('input[name="category_id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/trash-category-recover",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Category recovered.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//------ Category trash modal call ------//
function openTrashDeleteModel(){
    $('#trashDeleteModal').modal('show'); 
}

//----- Category Trash delete permanently  -----//
$(document).on("click","#trash-delete-btn",function(){
    var id = $.map($('input[name="category_id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/trash-category-delete",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Category deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//----- Single Category Trash delete permanently  -----//
function singleTrashCategoryDelete(id){
    $.ajax({
        type: "POST",
        url: "/admin/trash-category-delete",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Category deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
}

//------ Product trash modal call ------//
function openTrashProductRecoverModel(){
    $('#trashProductRecoverModal').modal('show'); 
}

//----- Product Trash Check All Functionality -----//
$("#product_chk_all").click(function () {
    if ($(this).prop('checked')) {
        $(".product_chk_child").prop("checked", true);
    } else {
        $(".product_chk_child").prop("checked", false);
    }
});

//----- Product Trash recover  -----//
$(document).on("click","#trash-product-recover-btn",function(){
    var id = $.map($('input[name="product_id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/trash-product-recover",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Product recovered.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//------ Product trash modal call ------//
function openTrashProductDeleteModel(){
    $('#trashProductDeleteModal').modal('show'); 
}

//----- Product Trash delete permanently  -----//
$(document).on("click","#trash-product-delete-btn",function(){
    var id = $.map($('input[name="product_id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/trash-product-delete",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Product deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//----- Single Product Trash delete permanently  -----//
function singleTrashProductDelete(id){
    $.ajax({
        type: "POST",
        url: "/admin/trash-product-delete",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Product deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
}

//------ Member trash modal call ------//
function openTrashMemberRecoverModel(){
    $('#trashMemberRecoverModal').modal('show'); 
}

//----- Member Trash Check All Functionality -----//
$("#member_chk_all").click(function () {
    if ($(this).prop('checked')) {
        $(".member_chk_child").prop("checked", true);
    } else {
        $(".member_chk_child").prop("checked", false);
    }
});

//----- Member Trash recover  -----//
$(document).on("click","#trash-member-recover-btn",function(){
    var id = $.map($('input[name="member_id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/trash-member-recover",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Registration recovered.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//------ Member trash modal call ------//
function openTrashMemberDeleteModel(){
    $('#trashMemberDeleteModal').modal('show'); 
}

//----- Member Trash delete permanently  -----//
$(document).on("click","#trash-member-delete-btn",function(){
    var id = $.map($('input[name="member_id[]"]:checked'), function(c){return c.value; });
    id = JSON.stringify(id);
    $.ajax({
        type: "POST",
        url: "/admin/trash-member-delete",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Registration deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
})

//----- Single Member Trash delete permanently  -----//
function singleTrashMemberDelete(id){
    $.ajax({
        type: "POST",
        url: "/admin/trash-member-delete",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                toastr.info(
                    'Registration deleted.','',
                  {
                    timeOut: 1000,
                    fadeOut: 1000,
                    onHidden: function () {
                      window.location.reload();
                   }
                 });
            }
        }
    })
}

//----- Member individual record show -----//
function getIndividualMemberRecord(id){
    $.ajax({
        type: "POST",
        url: "/admin/member-record",
        data: { id: id },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            $("#record").show();
            $("#record").html(result);
        }
    })
}

//----- Add  Category -----//
jQuery("#addCategory").submit(function (e) {
    e.preventDefault();
    jQuery.ajax({
        url: "/admin/category/store",
        type: "POST",
        data: jQuery("#addCategory").serialize(),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (result) {
            if (result.status == "error") {
                jQuery.each(result.error, function (key, value) {
                    jQuery("#" + key + "_error").html(value[0]);
                });
            }
            if (result.status == "success") {
                window.location.href = '/admin/category';
            }
        },
    });
});

//----- Add  Sub Category -----//
jQuery("#addSubCategory").submit(function (e) {
    e.preventDefault();
    jQuery.ajax({
        url: "/admin/sub-category/store",
        type: "POST",
        data: jQuery("#addSubCategory").serialize(),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (result) {
            if (result.status == "error") {
                jQuery.each(result.error, function (key, value) {
                    jQuery("#" + key + "_error").html(value[0]);
                });
            }
            if (result.status == "success") {
                window.location.href = '/admin/sub-category/'+ result.id;
            }
        },
    });
});

//----- All product to level C  -----//
function showAllToLevelC(){
    $.ajax({
        type: "POST",
        url: "/admin/show-all-to-level-c",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(result){
            if( result = "success" ){
                window.location.reload();
            }
        }
    })
}