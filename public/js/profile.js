$( document ).ready(function() {
    console.log( "profile.js loaded!" );

    $('#createcommunityurl').on('keyup', function(){
        $("#comm_url_example").text(this.value);
    });
});
