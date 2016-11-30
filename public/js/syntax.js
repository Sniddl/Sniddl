$('.syntax').each(function(){
  var content = $(this).html();
  content = content.replace(/&/g, "&amp;")
                   .replace(/</g, "&lt;")
                   .replace(/>/g, "&gt;")
                   .replace(/"/g, "&quot;")
                   .replace(/'/g, "&#039;");


  var htmlTags = [
    "h1","h2","h3","h4","h5","h6","p","div","span","ul","ol","li","form","button","input"]
  var htmlAttributes = [
    "class", "value", "id",
  ]
  var strings = [
    "\"", "'", "`",
  ]



  for (var b= 0; b< strings.length; b++) {
   var regex = new RegExp("'.*'", "g");
    content = content.replace(regex, function(match, content){
              console.log(match);
              return "<span class='strings'>"+match+"</span>";});}

  for (var b= 0; b< htmlAttributes.length; b++) {
   var regex = new RegExp(htmlAttributes[b]+"=|"+htmlAttributes[b]+" =", "g");
    content = content.replace(regex, function(match, content){
              return "<span class='html-attribute'>"+match+"</span>";});}

  for (var i = 0; i < htmlTags.length; i++) {
    var regex = new RegExp("&lt;"+htmlTags[i]+"|&lt;\/"+htmlTags[i]+"&gt;*", "g");
    content = content.replace(regex, function(match, content){
              var c = (htmlTags[i].length) +4;
              //console.log(match, matc);
              return (match.length > c) ? "&lt;<span class='html-entity'>"+match.slice(4,-4)+"</span>&gt;" : "&lt;<span class='html-entity'>"+match.slice(4)+"</span>";});}


  $(this).html(content)
});
