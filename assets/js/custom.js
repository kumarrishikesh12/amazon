$(document).ready(function () {
    $("#category_name").keyup(function () {
        $.ajax({
            type: "POST",
            url: "http://localhost/amazon/index.php/home/GetCategoryName",
            data: {
                keyword: $("#category_name").val()
            },
            dataType: "json",
            success: function (data) {
                if (data.length > 0) {
                    $('#DropdownCategory').empty();
                    $('#category_name').attr("data-toggle", "dropdown");
                    $('#DropdownCategory').dropdown('toggle');
                }
                else if (data.length == 0) {
                    $('#category_name').attr("data-toggle", "");
                }
                $.each(data, function (key,value) {
                    if (data.length >= 0)
                        $('#DropdownCategory').append('<li role="displayCategory" ><a role="menuitem dropdownCountryli" class="dropdownlivalue">' + value['cname'] + '</a></li>');
                });
            }
        });
    });
    $('ul.txtcategory').on('click', 'li a', function () {
        $('#category_name').val($(this).text());
    });
});
