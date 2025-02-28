// convert a string from snake case (a_b_c) to camel case (aBC)
function snakeToCamel(str) {
    return str
        .replace(/^ref_/, '') // Remove "ref_" prefix if it exists
        .replace(/_([a-z])/g, (match, letter) => letter.toUpperCase()); // Convert snake_case to camelCase
}

// converts all object keys to camel case
function formatObject(object){
    let formattedObject = {};
    Object.keys(object).forEach(key => {
        formattedObject[snakeToCamel(key)] = object[key];
    });
    return formattedObject
}

// this will populate values from object to input.
function populateValues(object){
    $.each(object, function (key, value) {
        let input = $('[name="' + key + '"]');

        if (input.is(':checkbox')) {
            input.prop('checked', value == 1);
        } else if (input.is('select')) {
            input.val(value).trigger('change'); // For Select2 dropdowns
        } else {
            input.val(value);
        }
    });
}
