$(function() {
    addParam();
});

function addParam() {
    var row = '';
    row += '<div class="row">';
    row += '    <div class="col-lg-1"><a class="btn btn-danger btn-block" style="margin-top: 25px;" onclick="deleteParam(this);">حذف</a></div>';
    row += '    <div class="col-lg-4">';
    row += '        <div class="form-group">';
    row += '            <label class="control-label">نام</label>';
    row += '            <input class="form-control" type="text" name="EvParams[name][]" required/>';
    row += '        </div>';
    row += '    </div>';
    row += '    <div class="col-lg-4">';
    row += '        <div class="form-group">';
    //row += '            <label class="control-label">factor</label>';
    //row += '            <input class="form-control" type="number" name="EvParams[factor][]" required/>';
    row += '        </div>';
    row += '    </div>';
    row += '</div>';
    $('#params').append(row);
}

function info(data, success) {
    $.ajax({
        dataType: 'json',
        data: data,
        success: success
    });
}

function deleteParam(that) {
    $(that).parent().parent().remove();
}
function deleteOldParam(that, pid) {
    info({pid: pid}, function(result) {
        $(that).parent().parent().remove();
    });
}