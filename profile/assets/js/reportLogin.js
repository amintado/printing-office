function getOperations(field) {
    var operations = '';
    if (field.value !== '0') {
        operations += '<select class="form-control input-sm" style="padding: 0px 10px;" onchange="getInput(\'' + field.value + '\', this);">';
        operations += '    <option value="0">انتخاب کنید</option>';
        if (field.value === '1') {
            operations += '    <option value="1">برابر</option>';
            operations += '    <option value="2">کوچکتر</option>';
            operations += '    <option value="3">بزرگتر</option>';
            operations += '    <option value="4">بین</option>';
        }
        else if (field.value === '2' || field.value === '3') {
            operations += '    <option value="5">شبیه</option>';
            operations += '    <option value="6">شامل</option>';
        }
        else if (field.value === '4') {
            operations += '    <option value="7">در تاریخ</option>';
            operations += '    <option value="8">قبل از</option>';
            operations += '    <option value="9">بعد از</option>';
            operations += '    <option value="10">بین</option>';
        }
//        else if (field.value === '5') {
//            operations += '    <option value="11">درساعت</option>';
//            operations += '    <option value="12">قبل از</option>';
//            operations += '    <option value="13">بعداز</option>';
//            operations += '    <option value="14">بین</option>';
//        }

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
        if (field === '1') {
            if (operation.value === '4') {
                i1.html('<input type="text" class="form-control input-sm"/>');
                i2.html('<input type="text" class="form-control input-sm"/>');
            }
            else {
                i1.html('<input type="text" class="form-control input-sm"/>');
            }
        }
        else if(field==='4'){
            if (operation.value === '10') {
                i1.html($('<input type="text" class="form-control input-sm text-center" dir="ltr" placeholder="----/--/--" />').persianDatepicker({"formatDate": "YYYY/0M/0D", "theme": "default"}));
                i2.html($('<input type="text" class="form-control input-sm text-center" dir="ltr" placeholder="----/--/--" />').persianDatepicker({"formatDate": "YYYY/0M/0D", "theme": "default"}));
            }
            else {
                i1.html($('<input type="text" class="form-control input-sm text-center" dir="ltr" placeholder="----/--/--" />').persianDatepicker({"formatDate": "YYYY/0M/0D", "theme": "default"}));
            }
        }
        else {
            i1.html('<input type="text" class="form-control input-sm"/>');
        }
    }
}
function getData() {
    var data = [];
    $('#conditions .row').each(function() {
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
$(function() {
    $('#addCondition').on('click', function() {
        var conditionRow = '';
        conditionRow += '<div class="row" style="margin-bottom: 15px;">';
        conditionRow += '    <div class="col-lg-1"><a class="btn btn-block btn-sm btn-danger" onclick="$(this).parent().parent().remove();">حذف</a></div>';
        conditionRow += '    <div class="col-lg-2">';
        conditionRow += '        <select class="form-control input-sm" style="padding: 0px 10px;" onchange="getOperations(this);">';
        conditionRow += '            <option value="0">انتخاب کنید</option>';
        conditionRow += '            <option value="1">کد کاربر</option>';
        conditionRow += '            <option value="2">نام و نام خانوادگی</option>';
        conditionRow += '            <option value="3">نام کاربری</option>';
        conditionRow += '            <option value="4">تاریخ ورود</option>';
//        conditionRow += '            <option value="5">زمان ورود</option>';
        conditionRow += '        </select>';
        conditionRow += '    </div>';
        conditionRow += '    <div class="col-lg-3"></div>';
        conditionRow += '    <div class="col-lg-3"></div>';
        conditionRow += '    <div class="col-lg-3"></div>';
        conditionRow += '</div>';
        $('#conditions').append(conditionRow);
    }).trigger('click');
    $('#report').on('click', function() {
        info({report: true, data: getData()}, function(result) {
            var rows = '';

            if (result && result.data.length) {
                for (var index = 0, len = result.data.length; index < len; index++) {
                    var row=result.data[index];
                    rows += '<tr>';
                    rows += '    <td>' + (index+1) + '</td>';
                    rows += '    <td>' + row.user + '</td>';
                    rows += '    <td>' + row.fullname + '</td>';
                    rows += '    <td>' + row.username + '</td>';
                    rows += '    <td>' + row.date + '</td>';
                    rows += '    <td>' + row.time + '</td>';
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
    $('#excel').on('click', function(evt) {
        evt.preventDefault();
        $("a *").prop('disabled',true);
        var href = $(this).attr('href') + '/?type=login&data=' + JSON.stringify(getData());
        window.location = href;
    });
});