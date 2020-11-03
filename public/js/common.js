/* Validation Handling */
function showError(data, formID) {
    if (data.status == 422) {
        var dataArray = jQuery.parseJSON(data.responseText);
        if (dataArray.custom_error !== undefined) {
            $('p.error_msg').text(dataArray.custom_error);
            return;
        }
        renderError(dataArray.errors, formID);
    } else if (data.status == 403 || data.status == 401) {
        $('p.error_msg').text('You Are Not Authorised To Do This Action! Contact Tech Team For Support!!');
    } else {
        $('p.error_msg').text('An Error Occurred! Please Try Again Later!');
    }
}

function renderError(dataArray, formID) {
    console.log(dataArray)
    //remove all previous errors if exist
    $(".form-group").removeClass('has-error');
    $('.error-msg').remove();
    $.each(dataArray, function (fieldName, errorMessage) {
        if (fieldName.indexOf('.') > -1) {
            var splitString = fieldName.split('.');
            errorMessage = errorMessage[0].replace(/\.(.*?)\s/g, ' ');

            if (splitString.length == 2) {
                var fieldName = splitString[0] + '[]';                    
                var parentDiv = formID.find('input[name = "' + fieldName + '"], textarea[name = "' + fieldName + '"], select[name = "' + fieldName + '[]"], select[name = "' + fieldName + '"] ').eq(splitString[1]).closest('.form-group');
            }
        }else{
            var parentDiv = formID.find('input[name = "' + fieldName + '"], textarea[name = "' + fieldName + '"], select[name = "' + fieldName + '[]"], select[name = "' + fieldName + '"] ').closest('.form-group');
        }
               
        if(typeof parentDiv !== 'undefined'){
            parentDiv.addClass('has-error');
            parentDiv.children('label').after('<small class="error-msg pull-right text-red"> *' + errorMessage + '</small>');
        }
    });
}