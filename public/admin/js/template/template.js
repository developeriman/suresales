var makeContact = [];
var slno = 1;
var checkfield = -1;
$(document).ready(function() {
    $('#generatecode').click(function() {
        var templatename = $('#templatename').val();
        var prefix = $('#prefix').val();
        var noofcodes = $('#noofcodes').val();

        var _token = $('input[name="_token"]').val();

        $.post('./generatecode', {'templatename': templatename,'prefix':prefix,'noofcodes':noofcodes,'_token':_token}, function (data) {

           console.log('data.....'+ data)


        });

    });

    $('#savetemplate').click(function() {
        var _token = $('input[name="_token"]').val();
        const data = bindTemplate();
        $.post('./templatesave', {data,'_token':_token, name: 'Template 1'}, function (data) {

            console.log('data.....'+ data)
            slno = 0;
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

function bindTemplate()
{
    const template = [];
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
