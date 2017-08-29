function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i"), separator = uri.indexOf('?') !== -1 ? "&" : "?";
    return (uri.match(re) ? uri.replace(re, '$1' + key + "=" + value + '$2') : uri + separator + key + "=" + value);
}

function page_number(that) {
    window.location=updateQueryStringParameter(window.location.toString(), 'per-page', that.value);
}
