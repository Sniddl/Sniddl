window.base_url = function(relative=false) {
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
  return relative ? baseUrl+relative : baseUrl;
}

window.SelectText = function(element) {
    var doc = document
        , text = doc.getElementById(element)
        , range, selection
    ;
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}
