function loadZipCodes(){

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var headerHeight = $("div.header").css('height');
    var footerHeight = $("div.footer").css('height');
    var contentHeight = $("div.content").css('height');
    headerHeight = parseInt(headerHeight.split('px')[0]);
    footerHeight = parseInt(footerHeight.split('px')[0]);
    contentHeight = parseInt(contentHeight.split('px')[0]);
    totalContentHeight = headerHeight + footerHeight + contentHeight;
    loading();
    var load = 1;

    window.setInterval(function(){
        if(load == 1){
            $("#loading_text").html(".");
            load = 2;
        }
        if(load == 3){
            $("#loading_text").html("...");
            load = 4;
        }
    }, 1000);
    window.setInterval(function(){
        if(load == 2){
            $("#loading_text").html("..");
            load = 3;
        }
        if(load == 4){
            $("#loading_text").html(" ");
            load = 1;
        }
    }, 2000);

    function loading(){
        $.ajax({
            url: '/file/load/zipcodes',
            type: "POST",
            data: { _token:CSRF_TOKEN },
            dataType: 'JSON',
            success: function(data){
                window.location = "/person";
            },
            error: function(data, textStatus, errorThrown) { // What to do if we fail
                var error = JSON.stringify(data).split('{"')[1].split(',"')[1].split('"')[2];
                console.error('/file/load/zipcodes', textStatus, errorThrown.toString());
                window.location = "/loading/fail/"+error;
            }.bind(this)
        });
    }

}

