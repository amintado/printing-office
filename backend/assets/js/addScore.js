function change_ras(that) {
    if (that.value === '0') {
        $('#scores-score,#scores-flag').removeAttr('readonly').val('0');
    }
    else {
        var val = that.value.split(',');
        var id = val[0];
        var flag = val[1];
        var score = val[2];
        $('#scores-score').attr('readonly', true).val(score);
        $('#scores-flag').attr('readonly', true).val(flag);
    }
}