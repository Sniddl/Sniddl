$(document).ready(function() {

  $('.html').each(function(){
    var content = $(this).html();

    var blade = ["foreach","if","else","section","yield","extends","for","forelse","empty","while","unless","php","include","each","push","stack","inject"]

    blade.forEach(function(e){
        var regex = new RegExp("@"+e, "g")
        content = content.replace(regex, function(match, content){
                  //console.log(match);
                  return "<span class='blade'>"+match+"</span>";});
        var regex = new RegExp("@end"+e, "g")
        content = content.replace(regex, function(match, content){
                  //console.log(match);
                  return "<span class='blade'>"+match+"</span>";});});
        // P H P   V A R I A B L E S
        var regex = /\$[a-zA-Z0-9_]*]*/g;
        content = content.replace(regex, function(match, content){
                  //console.log(match);
                  return "<span class='php-variable'>"+match+"</span>";});//}
        $(this).html(content)


    var regex = new RegExp("{{(.*?)}}", "g")
    content = content.replace(regex, function(match, content){
              //console.log(match);
              return "<span class='blade'>"+match.slice(0,2)+"</span>"+"<span class='php'>"+match.slice(2,-2)+"</span>"+"<span class='blade'>"+match.slice(-2)+"</span>";});


    $(this).html(content)


  });

    $('.php').each(function(){
      var content = $(this).html();




        // P H P   V A R I A B L E S
        var regex = /\$[a-zA-Z0-9_]*]*/g;
        content = content.replace(regex, function(match, content){
                  //console.log(match);
                  return "<span class='php-variable'>"+match+"</span>";});//}
        $(this).html(content)

        // P H P   O B J E C T
        var regex = /-&gt;\S*(?=[a-zA-Z0-9\)\(])/g;
        content = content.replace(regex, function(match, content){
                  if(match.slice(-1) != "("){
                    return "<span class='php-object'>"+match+"</span>"
                  }else {
                    return match;};});
        $(this).html(content)

        // P H P   M E T H O D S
         var regex = /[a-zA-Z0-9_]*\(\V*\)|[a-zA-Z0-9_]*\(.*\)/g;
         content = content.replace(regex, function(match, content){
                   //console.log(match);
                   return "<span class='php-method'>"+match+"</span>";});//}
         $(this).html(content)


         // P H P   F A C A D E
          var regex = /[A-Z][a-zA-Z0-9_]*::/g;
          content = content.replace(regex, function(match, content){
                    //console.log(match);
                    return "<span class='php-facade'>"+match.slice(0,-2)+"</span>"+match.slice(-2);});//}
          $(this).html(content)



    });



});
