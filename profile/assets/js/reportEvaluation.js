function getOperations(field) {
    var operations = '';
    if (field.value !== '0') {
        operations += '<select class="form-control input-sm" style="padding: 0px 10px;" onchange="getInput(\'' + field.value + '\', this);">';
        operations += '    <option value="0">انتخاب کنید</option>';
        if (field.value === '1' || field.value === '7') {
            operations += '    <option value="1">برابر</option>';
            operations += '    <option value="2">کوچکتر</option>';
            operations += '    <option value="3">بزرگتر</option>';
            operations += '    <option value="4">بین</option>';
        }
        else if (field.value === '5' || field.value === '8') {
            operations += '    <option value="5">شبیه</option>';
            operations += '    <option value="6">شامل</option>';
        }
        else if (field.value === '2' || field.value === '9') {
            operations += '    <option value="7">در تاریخ</option>';
            operations += '    <option value="8">قبل از</option>';
            operations += '    <option value="9">بعد از</option>';
            operations += '    <option value="10">بین</option>';
        }
        else {
            operations += '    <option value="1">برابر</option>';
        }
        operations += '</select>';
    }
    $(field).parent().next().html(operations);
    $(field).parent().next().next().html('');
    $(field).parent().next().next().next().html('');
}
function getInput(field, operation) {
    var i1 = $(operation).parent().next().html('');
    var i2 = $(operation).parent().next().next().html('');
    if (operation.value !== '0') {
        if (field === '1' || field === '7') {
            if (operation.value === '4') {
                i1.html('<input type="text" class="form-control input-sm"/>');
                i2.html('<input type="text" class="form-control input-sm"/>');
            }
            else {
                i1.html('<input type="text" class="form-control input-sm"/>');
            }
        }
        else if (field === '2' || field === '9') {
            if (operation.value === '10') {
                i1.html($('<input type="text" class="form-control input-sm text-center" dir="ltr" placeholder="----/--/--" />').persianDatepicker({"formatDate": "YYYY/0M/0D", "theme": "default"}));
                i2.html($('<input type="text" class="form-control input-sm text-center" dir="ltr" placeholder="----/--/--" />').persianDatepicker({"formatDate": "YYYY/0M/0D", "theme": "default"}));
            }
            else {
                i1.html($('<input type="text" class="form-control input-sm text-center" dir="ltr" placeholder="----/--/--" />').persianDatepicker({"formatDate": "YYYY/0M/0D", "theme": "default"}));
            }
        }
        else if (field === '5' || field === '8') {
            i1.html('<input type="text" class="form-control input-sm"/>');
        }
        else {
            info({field: field}, function (result) {
                var data = '<select class="form-control input-sm" style="padding: 0px 10px;">';
                data += '    <option value="0">انتخاب کنید</option>';
                if (result && result.length) {
                    for (var index = 0, len = result.length; index < len; index++) {
                        var row = result[index];

                        data += '<option value="' + index + '">' + row + '</option>';
                    }
                }
                data += '</select>';
                i1.html(data);
            });
        }
    }
}
function getData() {
    var data = [];
    $('#conditions .row').each(function () {
        //$(this).children().eq(0);
        var field = $(this).children().eq(1).children('select').val() || '';
        var operation = $(this).children().eq(2).children('select').val() || '';
        var value1 = $(this).children().eq(3).children().val() || '';
        var value2 = $(this).children().eq(4).children().val() || '';
        data[data.length] = {
            field: field,
            operation: operation,
            value1: value1,
            value2: value2
        };
    });
    return data;
}
function info(data, success) {
    $.ajax({
        dataType: 'json',
        data: data,
        success: success
    });
}
$(function () {
    $('#addCondition').on('click', function () {
        var conditionRow = '';
        conditionRow += '<div class="row" style="margin-bottom: 15px;">';
        conditionRow += '    <div class="col-lg-1"><a class="btn btn-block btn-sm btn-danger" onclick="$(this).parent().parent().remove();">حذف</a></div>';
        conditionRow += '    <div class="col-lg-2">';
        conditionRow += '        <select class="form-control input-sm" style="padding: 0px 10px;" onchange="getOperations(this);">';
        conditionRow += '            <option value="0">انتخاب کنید</option>';
        conditionRow += '            <option value="1">کد ایده</option>';
        conditionRow += '            <option value="2">تاریخ ایده</option>';
        conditionRow += '            <option value="3">وضعیت ایده</option>';
        conditionRow += '            <option value="4">ارزیاب</option>';
        conditionRow += '            <option value="9">تاریخ ارزیابی</option>';
        conditionRow += '            <option value="5">متن ایده</option>';
        conditionRow += '            <option value="6">موضوع ایده</option>';
        conditionRow += '            <option value="7">نمره ارزیابی</option>';
        conditionRow += '            <option value="8">توضیح</option>';
        conditionRow += '        </select>';
        conditionRow += '    </div>';
        conditionRow += '    <div class="col-lg-3"></div>';
        conditionRow += '    <div class="col-lg-3"></div>';
        conditionRow += '    <div class="col-lg-3"></div>';
        conditionRow += '</div>';
        $('#conditions').append(conditionRow);
    }).trigger('click');
    $('#report').on('click', function () {
        info({report: true, data: getData()}, function (result) {
            var rows = '';
            if (result && result.data && result.data.length) {
                for (var index = 0, len = result.data.length; index < len; index++) {
                    var row = result.data[index];
                    rows += '<tr>';
                    rows += '    <td>' + (index + 1) + '</td>';
                    rows += '    <td>' + (row.ev_user_fullname ? row.ev_user_fullname : '---') + '</td>';
                    rows += '    <td>' + (row.ev_idea_id ? row.ev_idea_id : '---') + '</td>';
                    rows += '    <td>' + (row.idea_description ? row.idea_description : '---') + '</td>';
                    rows += '    <td>' + (row ? row.categories : '---') + '</td>';
                    rows += '    <td>' + (row.ev_score ? row.ev_score : '---') + '</td>';
                    rows += '    <td>' + (row.ev_description ? row.ev_description : '---') + '</td>';
                    rows += '</tr>';
                }
            }
            else {
                rows += '<tr><td colspan="7" align="center">-- بدون محتوی --</td></tr>';
            }
            $('#total_count').html(result.count);
            $('#tableResult').html(rows);
            $("a *").prop('disabled',false);

        });
    });
    $('#excel').on('click', function (evt) {
        evt.preventDefault();
        $("a *").prop('disabled',true);
        var href = $(this).attr('href') + '/?type=idea&data=' + JSON.stringify(getData());
        window.location = href;
    });
});