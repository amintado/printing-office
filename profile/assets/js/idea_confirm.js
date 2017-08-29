function deleteIdea(that, IdeaID, AttID, confirmMsg) {
    if (confirm(confirmMsg)) {
        $.ajax({
            url: 'delete-attachment',
            dataType: 'json',
            data: {
                IdeaID: IdeaID,
                AttID: AttID
            },
            success: function (result) {
                if (result.rows === 1) {
                    $(that).parent().remove();
                    if ($('#attachments li').length === 0) {
                        $('#attachments').append('<li style="margin-bottom: 5px;" id="withoutAttachment"><label style="display: block; text-align: center; background: rgb(238, 238, 238) none repeat scroll 0% 0%; padding: 10px; color: rgb(85, 85, 85);">-- بدون ضمیمه --</label></li>');
                    }
                }
            }
        });
    }
}