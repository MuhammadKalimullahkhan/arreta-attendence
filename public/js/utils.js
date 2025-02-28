function snakeToCamel(str) {
    return str.replace(/_([a-z])/g, (match, letter) => letter.toUpperCase());
}

function formatObject(object){
    let formattedObject = {};
    Object.keys(object).forEach(key => {
        formattedObject[snakeToCamel(key)] = object[key];
    });
    return formattedObject
}
