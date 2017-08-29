var festival_num = 0;

function a1(num) {
    var row = '';
    row += '<div class=\"row\">';
    row += '    <div class=\"col-lg-12\" style=\"margin-bottom: 15px;\">';
    row += '        <div class=\"row\">';
    row += '            <div class=\"col-lg-1\">';
    row += '                <a class=\"btn btn-danger btn-block\" onclick=\"$(this).parent().parent().parent().parent().remove();\">حذف</a>';
    row += '            </div>';
    row += '            <div class=\"col-lg-4\">';
    row += '                <input type=\"text\" name=\"FestivalCategory[title][' + num + '][name]\" class=\"form-control\"/>';
    row += '            </div>';
    row += '            <div class=\"col-lg-1\">';
    row += '                <a class=\"btn btn-primary btn-block\" onclick=\"addChild(this, ' + num + ');\"><i class=\"fa fa-plus\" style=\"margin:0;font-size:14px !important\"></i></a>';
    row += '            </div>';
    row += '        </div>';
    row += '    </div>';
    row += '    <div class=\"col-lg-12\">';
    row += '        <div class=\"row\">';
    row += '        </div>';
    row += '    </div>';
    row += '</div>';
    $('#params').append(row);
}
function addChild(that, num) {
    var col = '';
    col += '<div class=\"form-group\">';
    col += '    <div class=\"col-lg-1 col-lg-offset-1\">';
    col += '        <a class=\"btn btn-danger btn-block\" onclick=\"$(this).parent().parent().remove();\">حذف</a>';
    col += '    </div>';
    col += '    <div class=\"col-lg-4\">';
    col += '        <input type=\"text\" name=\"FestivalCategory[title][' + num + '][children][]\" class=\"form-control\"/>';
    col += '    </div>';
    col += '    <div class=\"clearfix\"></div>';
    col += '</div>';

    $(that).parent().parent().parent().next().children().append(col);
}

$(function () {
    $('#append').click(function (e) {
        a1(festival_num++);
    });
});

