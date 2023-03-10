let slno = 1;
$(document).ready(function() {
    $('#generatecode').click(function() {
        let template_id = $('#template_id').val();
        let prefix = $('#prefix').val();
        let num_of_digit = $('#num_of_digit').val();

        let _token = $('input[name="_token"]').val();

        $.post('./generatecode', {
            'template_id': template_id,
            'prefix': prefix,
            'num_of_digit': num_of_digit,
            '_token': _token
        }, function (data) {

           location.reload();
        });

    });

    $('#savetemplate').click(function() {
        let _token = $('input[name="_token"]').val();
        let title = $('#data_title').val();
        const data = bindTemplate();
        $.post('./templatesave', {data,'_token':_token, name: title}, function (data) {
            location.reload();
        });
    });

    $('#addrow').click(function() {
        slno++;
        $('#appendrow').append(`
            <tr id="template-row-${slno}">
                <td><input type="text" class="form-control" id="template-input-${slno}" value=""></td>
                <td>
                    <select class="form-select" value="text" id="template-input-type-${slno}">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="read_only">Read Only</option>
                        <option value="image">Image</option>
                    </select>
                </td>
            </tr>
        `);

    });

});

function removerow() {
    $(`#template-row-${slno}`).remove();
    slno--;
}

function clearTemplate() {
    $(`#template-input-1`).val('');
    $(`#template-input-type-1`).val('');
    for(let i = 2; i <= slno; i++) {
        $(`#template-row-${i}`).remove();
    }
    slno = 1;
}

function bindTemplate()
{
    const template = [{
        field: 'userid',
        type: 'text'
    }];
    for(let i = 1; i <= slno; i++) {
        let field = $(`#template-input-${i}`).val();
        let type = $(`#template-input-type-${i}`).val();

        template.push({
            field,
            type
        })
    }

    return template;

}
