$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    // you can use originalOptions.type || options.type to restrict specific type of requests
    options.data = jQuery.param($.extend(originalOptions.data||{}, {
        timeStamp: new Date().getTime()
    }));
});
$.support.cors = true;
$.mobile.allowCrossDomainPages = true;
$(function(){
    
    var pathArray = window.location.href.split( '/' );
    var protocol = pathArray[0];
    var host = pathArray[2];
    var home_url = protocol + '//' + host;
    
    //change page
    $(".footer_nav a").live('tap', function(e){
        e.preventDefault();
        var page=$(this).attr('id');
        $.mobile.changePage( "#"+page, {
            transition: "slideup"
        } );
    }) 
    
    //view full news
    $("a.read_more_wrap").live("tap", function(e){
        e.preventDefault();
        var the_id=$(this).parents('article').attr('id');
        $("input#the_news_id").val(the_id);
        //$.mobile.changePage("#news");
        //$("form[name=news_link]").submit();
        localStorage.setItem("full_news", the_id);
        $.mobile.changePage("#news", {
            transition: "slideup"
        });
    })
    
    //login
    $(".submit-log-in").live("tap", function(e){
        e.preventDefault();
        if($("#log_email").val() != "" && $("#log_pass").val() != ""){
            var the_email=$("#log_email").val();
            var the_pass=$("#log_pass").val();
            login(the_email, the_pass);
        }else{
            alert ("Nu ai completat toate campurile");
        }
    })
    //like news
    $("a.like_wrap").live('tap', function(e){
        e.preventDefault();
        var id=$(this).parents('article').attr('id');
        like(id);
    })
    
    //share
    $("a.active_share").live('tap', function(e){
        e.preventDefault();
        var the_news_id=$(this).parent().parent().attr('id');
        share(the_news_id);
    })
    
    //logout
    $("a#logout").on('tap', function(e){
        e.preventDefault();
        logout();
    })
    
    //comment 
    $("#submit_comment").live("tap", function(e){
        e.preventDefault();
        var comment_length=$("textarea#comment_content").val().length;

        if(comment_length < 3 ){
            alert('Comentariul este prea scurt..');
        }else{
            var the_news_id = $("#news section.news").attr("id");
            var the_comment = $("textarea#comment_content").val();
            comment(the_comment, the_news_id);
        }
    })
    
    //options submit
    $("#options form[name='news_options'] a").live("tap", function(e){
        e.preventDefault();
        var opt= $(this).attr('id');
        //$("#options #page_opt").val(opt);
        //$("#options form[name='news_options']").submit();
        localStorage.setItem("multi_news", opt);
        $.mobile.changePage("#multi_news", {
            transition: "slideup"
        });
    })
    
    //recommended news
    $("a.view_recommended").live("tap", function(e){
        e.preventDefault();
        var reco =$(this).attr('id');
        localStorage.setItem("reco_news", reco);
        $.mobile.changePage("#recommended_news", {
            transition: "slideup"
        });
    })
    
    //recommended by folowed users
    
    $("a#followed_news").live("tap", function(e){
        e.preventDefault();
        localStorage.setItem("reco_news", 'fol');
        $.mobile.changePage("#recommended_news", {
            transition: "slideup"
        });
    })
    
    //get news by location
    
    $("a#news_by_location").live("tap", function(e){
        e.preventDefault();
        $.mobile.changePage("#news_by_location", {
            transition: "slideup"
        });
    })
    
    // get news by publication
    $("a.publication").live("tap", function(e){
      e.preventDefault();
      var publication = $(this).attr('id');
      localStorage.setItem("publication", publication);
      $.mobile.changePage("#news_by_publication", {
            transition: "slideup"
        });
    })
    
    $("#publics a").live("tap", function(e){
      e.preventDefault();
      var publication = $(this).attr('id');
      localStorage.setItem("publication", publication);
      $.mobile.changePage("#news_by_publication", {
            transition: "slideup"
        });
    })
    
    //search
    $("input.search_text").live('keyup',function(){
        if($(this).val()!=""){
            search($(this).val());   
        }else{
            $(".search_results").html('Nu ai introdus nici un termen de cautat..');
        }
    });
    
    //categories submit
    $("#categories form[name='news_categories'] a").live("tap", function(e){
        e.preventDefault();
        var opt= $(this).attr('id');
        //$("#categories #news_cat").val(opt);
        //$("#categories form[name='news_categories']").submit();
        localStorage.setItem("cat_news", opt);
        $.mobile.changePage("#category", {
            transition: "slideup"
        });
    })
    // go to publications
    $("a#all_publications").live("tap", function(){
        //e.preventDefault();
        $.mobile.changePage("#publications", {
            transition: "slideup"
        });
    })
    
    //register
    $(".submit-register").live('tap', function(e){
        e.preventDefault();
        var name=$("#register_name").val();
        var email=$("#register_email").val();
        var pass=$("#register_password").val();
        var pass2=$("#register_password2").val();
        if(name != "" && email != "" && pass != "" && pass2 != ""){
            if(pass != pass2){
                alert("Parolele nu se potrivesc");
            }else{
                register(name, email, pass);
            }
        }else{
            alert("Nu ai completat toate campurile");
        }
    })
    
    $("#reg_again").live('tap', function(e){
        e.preventDefault();
        $("#register section#register_resp").slideupOut();
        $("#register section.reg_form").slideupIn();
    })
    
    $("a.other_user").live("tap", function(e){
        e.preventDefault();
        var the_id=$(this).attr('id');
        localStorage.setItem("user_id", the_id);
        $.mobile.changePage("#profile", {
            transition: "slideup"
        });
    })
    $("a.foll_user_link").live("tap", function(e){
        e.preventDefault();
        var the_id=$(this).attr('id');
        localStorage.setItem("user_id", the_id);
        $.mobile.changePage("#profile", {
            transition: "slideup"
        });
    //$("input#the_multi_user_id").val(the_id);
    //$("form[name=multi_user_link]").submit();
    })
    $(".submit-view_profile").live("tap", function(){
        var the_id=$(this).attr('id');
        localStorage.setItem("user_id", the_id);
        $.mobile.changePage("#profile", {
            transition: "slideup"
        });
    //$("input#the_multi_user_id").val(the_id);
    //$("form[name=multi_user_link]").submit();
    })
    $("a.read_more_search").live("tap", function(e){
        e.preventDefault();
        var the_id=$(this).parent().parent().attr('id');
        localStorage.setItem("full_news", the_id);
        $.mobile.changePage("#news", {
            transition: "slideup"
        });
    //$("input#search_the_news_id").val(the_id);
    //$("form[name=search_news_link]").submit();
    })
    $("a.follow").live("tap", function(e){
        e.preventDefault();
        var the_user_id=$(this).siblings(".full_profile_wrap").attr('id');
        follow(the_user_id);
    })
    $("a.unfollow").live("tap", function(e){
        e.preventDefault();
        var the_user_id=$(this).siblings(".full_profile_wrap").attr('id');
        unfollow(the_user_id);
    })
    $("form[name=follow_form] a").live("tap", function(){
        var the_user_type=$(this).attr('id');
        localStorage.setItem("user_type", the_user_type);
        $.mobile.changePage("#multi_users", {
            transition: "slideup"
        });
    //$("input#user_type").val(the_user_type);
    //$("form[name=follow_form]").submit();
    })
    
    
    
    //get location
    $("#get_location").live("tap", function(){
        if(Modernizr.geolocation){
            if (navigator && navigator.geolocation) {
                // make the request for the user's position
                navigator.geolocation.getCurrentPosition(geo_success, geo_error);
            } else {
                // use MaxMind IP to location API fallback
                alert('Browserul dumneavoastra nu suporta geolocation :(');
            }
        }else{
            alert('Browserul dumneavoastra nu suporta geolocation :(');
        }
    })
    
    //salveaza modificari profil
    $("#save_profile").live("tap", function(){
        var pro_name = $("#pro_name").val();
        var pro_age = $("#pro_age").val();
        var pro_location = $("#pro_location").val();
        var pro_avatar = $("#pro_avatar").val();
        
        var pro_pass_old = $("#pro_pass_old").val();
        var pro_pass_new = $("#pro_pass_new").val();
        var pro_pass_new2 = $("#pro_pass_new2").val();
        
        if(pro_pass_old != "" || pro_pass_new != "" || pro_pass_new2 != "" ){
            if(pro_pass_old == "" || pro_pass_new == "" || pro_pass_new2 == "" ){
                alert("Incercarea de a schimba parola a esuat. Nu ati completat toate campurile necesare");
                return;
            }else{
                if(pro_pass_new != pro_pass_new2){
                    alert("Parolele nou introduse nu coincid");
                    return;
                }
            }
        }
        
        update_profile(pro_name, pro_age, pro_location, pro_avatar, pro_pass_old, pro_pass_new);
        
        
    })
    
    //show next 10 news
    $("#next10").live("tap", function(e){
        e.preventDefault();
        var section = $(this).parents('section');
        var last_visible = section.children('.tbshow').size();
        var last = section.children('article').size();
        if(last_visible < last){
            var new_first = last_visible + 1;
            if(last_visible + 10 < last){
                var last_to_be = last_visible + 10;
            }else{
                var last_to_be = last;
                $(this).hide();
            }
            var i = new_first;
            while(i<= last_to_be){
                section.children('article').eq(i).addClass('tbshow');
                i++;
            }
        }else{
            $(this).hide();
        }
        
        
    });

    
})
$(".ui-page").live("pagebeforeshow", function(){
    $(".ui-content").html('');
    $(".ui-loader").show();
})
//load content
$(".ui-page").live("pageshow", function( event ) {
    
    var page_id = $(this).attr('id');
    var full_news = localStorage.getItem("full_news");
    var multi_news = localStorage.getItem("multi_news");
    var reco_news = localStorage.getItem("reco_news");
    var news_catg = localStorage.getItem("cat_news");
    var user_typeo = localStorage.getItem("user_type");
    var user_ido = localStorage.getItem("user_id");
    var pub = localStorage.getItem("publication");
    $('#'+page_id+" .ui-content").load('core/view/content/'+page_id+'.php', {
        the_news_id: full_news, 
        page_opt: multi_news,
        page_reco: reco_news,
        news_cat:news_catg, 
        user_type:user_typeo, 
        the_user_id:user_ido,
        publication:pub
    }, function() {
        $('#'+page_id+" .ui-content").trigger('create');
        $(".ui-loader").hide();
    });
    
} );


function geo_success(position) {
    printAddress(position.coords.latitude, position.coords.longitude);
}
 
function geo_error(err) {
    alert('A aparut o eroace cand incercam sa va preiau locatia :(');
// instead of displaying an error, fall back to MaxMind IP to location library
//printAddress(geoip_latitude(), geoip_longitude(), true);
}

function printAddress(latitude, longitude) {
    // set up the Geocoder object
    var geocoder = new google.maps.Geocoder();
 
    // turn coordinates into an object
    var yourLocation = new google.maps.LatLng(latitude, longitude);
 
 
    // find out info about our location
    geocoder.geocode({
        'latLng': yourLocation
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                for (var i=0; i<results[0].address_components.length; i++) {
                    for (var b=0;b<results[0].address_components[i].types.length;b++) {

                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                        if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                            //this is the object you are looking for
                            city= results[0].address_components[i];
                            break;
                        }
                    }
                }
                //city data
                //alert(city.long_name)     
                $("#pro_location").val(city.long_name);
            } else {
                alert('Google did not return any results.');
            }
        } else {
            alert("Reverse Geocoding failed due to: " + status);
        }
    /*                             
        var image_url = "http://maps.google.com/maps/api/staticmap?sensor=false&center=" + latitude + "," +  
        longitude + "&zoom=15&size=800x400&markers=color:blue|label:S|" +  
        latitude + ',' + longitude;  
       
        $('body').append(  
            $(document.createElement("img")).attr("src", image_url).attr('id','map')  
        );
        */
    });  
// if we used MaxMind for location, add attribution link
}

function update_profile(pro_name, pro_age, pro_location, pro_avatar, pro_pass_old, pro_pass_new){
    $.ajax({
        url: 'core/controller/update_profile_ajax.php',
        type: 'POST',
        data:{
            name: pro_name,
            age: pro_age,
            location: pro_location,
            avatar: pro_avatar,
            pass_old: pro_pass_old,
            pass_new: pro_pass_new
        },
        success:function(response){
            var error_msg ='', success_msg='Detaliile au fost actualizate';
            $("form#edit_my_profile .warn").html("");
            var msg = $.parseJSON(response);
            if(msg.changed_pass != null){
                if(msg.changed_pass != "ok"){          
                    error_msg = error_msg + msg.alert_pass;
                    $("form#edit_my_profile .warn").show().append('<span class="unsuccess">'+msg.alert_pass+'<span>').delay(2000).slideupOut('slow');
                }
            }
            
            if(msg.changed_age != null){
                if(msg.changed_age != "ok"){
                    error_msg = error_msg + msg.alert_age;
                    
                }
            } 
            
            if(error_msg == ""){
                $("form#edit_my_profile .warn").show().append('<span class="success">'+success_msg+'<span>').delay(2000).slideupOut('slow');
            }else{
                $("form#edit_my_profile .warn").show().append('<span class="unsuccess">'+error_msg+'<span>').delay(2000).slideupOut('slow');
            }
            error_msg ='';
        }
    })
}

function login(email, pass){
    $.ajax({
        url: 'core/controller/login_ajax.php',
        type: 'POST',
        data:{
            log_email: email,
            log_pass: pass
        }, 
        success:function(response){
            var msg = $.parseJSON(response);   
            if(msg.response == 'ok'){
                $(".log-in-cont .warn").html('<span class="success">autentificare reusita</span>');
                setTimeout(function() {
                    window.location.replace("http://lucianbarticel.ro/licenta");
                }, 1500);
            }else{
                $(".log-in-cont .warn").html('<span class="unsuccess">autentificare nereusita. Mai incearca odata</span>').delay(2000).slideupOut('slow');
            }
        }
    })
}

function like(id){
    
    $.ajax({
        url: 'core/controller/like_ajax.php',
        type: 'POST',
        data:{
            post_id:id
        }, 
        success:
        function(response){
            var msg=$.parseJSON(response);
            $("article#"+id+" section.news_footer a.like_wrap").html(msg.likes);
        }
    })
}

function share(news_id){
    $.ajax({
        url: 'core/controller/share_ajax.php',
        type: 'POST',
        data:{
            post_id:news_id
        }, 
        success:
        function(response){
            var msg=$.parseJSON(response);
            if(msg.response=='ok'){
                $("article#"+news_id+" section.news_footer a.share_wrap").removeClass("active_share");
                $("article#"+news_id+" section.news_footer a.share_wrap").addClass("inactive_share");
            }else{
                console.log(msg.response);
            }
        }
    })
}

function logout(){
    $.ajax({
        url: 'core/controller/logout_ajax.php',
        type: 'POST',
        success:function(response){
           
            window.location.replace("http://lucianbarticel.ro/licenta");
            
        }
    })
}

function comment(comment_cont, news_id){
    $.ajax({
        url: 'core/controller/comment_ajax.php',
        type: 'POST',
        data:{
            comment: comment_cont,
            newsid: news_id
        }, 
        success:function(response){
            var msg = $.parseJSON(response);
            var arr_length= msg.response.length;
            var comments_html="";
            for (var i = 0; i < arr_length; i++) {
                comments_html=comments_html+'<div class="single_comment"><div class="comment_avatar"><img class="com_avatar" src="images/avatar.jpg" alt="comment_avatar"/></div><div class="comment_it_is"><div class="comment_meta"><span class="com_user_email" >'+msg.response[i]['email']+'</span><span class="com_date">'+msg.response[i]['data']+'</span></div><div class="comment_text"><p>'+msg.response[i]['comentariu']+'</p></div></div></div>'
            //console.log(msg.response[i]['user_email']);
            }
            $('.comments').html(comments_html);
        }
    })
}

function search(string){
    $.ajax({
        url: 'core/controller/search_ajax.php',
        type: 'POST',
        data:{
            search_string: string
        }, 
        success:function(response){
            var msg = $.parseJSON(response);
            var arr_length= msg.response.length;
            var news_html='<div class="search_results">';
            for (var i = 0; i < arr_length; i++) {
                news_html=news_html+'<article class="one_result" id="'+msg.response[i]['news_id']+'"><h2>'+msg.response[i]['news_title']+'</h2><span><a class="read_more_search">Vezi intreaga stire</a></span></article>';
            }
            news_html=news_html+'</div>';
            $(".search_results").replaceWith(news_html);
        }
    })
}

function register(name, email, pass){
    $.ajax({
        url: 'core/controller/register_ajax.php',
        type: 'POST',
        data:{
            reg_name: name,
            reg_email: email, 
            reg_pass: pass
        }, 
        success:function(response){
            var msg = $.parseJSON(response);
            $("#register #the_reg_mess").html(msg.response);
            $("#register section.reg_form").slideupOut();
            $("#register section#register_resp").slideupIn();
        }
    })
}

function follow(the_user_id){
    $.ajax({
        url: 'core/controller/follow_ajax.php',
        type: 'POST',
        data:{
            user_id:the_user_id
        }, 
        success:
        function(response){
            var msg=$.parseJSON(response);
            $(".profile_followers h3 a").html(msg.followers);
            $("a#follow_button").removeClass('follow');
            $("a#follow_button").addClass('unfollow');
            $("a#follow_button span.ui-btn-text").html('Inceteaza sa mai urmaresti');
        }
    })
}

function unfollow(the_user_id){
    $.ajax({
        url: 'core/controller/unfollow_ajax.php',
        type: 'POST',
        data:{
            user_id:the_user_id
        }, 
        success:
        function(response){
            var msg=$.parseJSON(response);
            $(".profile_followers h3 a").html(msg.followers);
            $("a#follow_button").removeClass('unfollow');
            $("a#follow_button").addClass('follow');
            $("a#follow_button span.ui-btn-text").html('Urmareste');
        }
    })
}