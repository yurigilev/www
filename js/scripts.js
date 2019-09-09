function moveData(id) 
{
    textName='#text'+id;
    hiddenStatus='#status'+id;
    $('#editID').val(id);
    $('#editText').val($(textName).text());
    if ($(hiddenStatus).val()=='work') {
        $('#editBox').prop('checked', false);
    } else {
        $('#editBox').prop('checked', true);
    }
}