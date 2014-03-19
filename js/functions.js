$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    // you can use originalOptions.type || options.type to restrict specific type of requests
    options.data = jQuery.param($.extend(originalOptions.data||{}, {
        timeStamp: new Date().getTime()
    }));
});
function showLikes(id, likes){
    $("article#"+id+" section.news_footer a.like_wrap").html(likes);
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
            showLikes(id, msg.likes);
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
            $("#register section.reg_form").fadeOut();
            $("#register section#register_resp").fadeIn();
            setTimeout(function() {
                window.location.replace("http://lucianbarticel.ro/licenta");
            }, 1500);
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
                $(".log-in-cont").prepend('<section class="warn success"><span class="success">autentificare reusita</span></section>');
                setTimeout(function() {
                    window.location.replace("http://lucianbarticel.ro/licenta");
                }, 1500);
            }else{
                $(".log-in-cont").prepend('<section class="warn unsuccess"><span class="unsuccess">autentificare nereusita. Mai incearca odata</span></section>')
            }
        }
    })
}
function logout(){
    $.ajax({
        url: 'core/controller/logout_ajax.php',
        type: 'POST',
        success:function(response){
            var msg = $.parseJSON(response);
            $(".my-account-cont").prepend(msg.response);
            setTimeout(function() {
                window.location.replace("http://lucianbarticel.ro/licenta");
            }, 1500);
            
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
                comments_html=comments_html+'<div class="single_comment"><div class="comment_avatar"><img class="com_avatar" src="images/avatar.jpg" alt="comment_avatar"/></div><div class="comment_it_is"><div class="comment_meta"><span class="com_user_email" >'+msg.response[i]['user_name']+'</span><span class="com_date">'+msg.response[i]['comment_date']+'</span></div><div class="comment_text"><p>'+msg.response[i]['comment_content']+'</p></div></div></div>'
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
            if(msg.response=='ok'){
                $(".profile_followers h3 a").html(msg.followers);
                $("a#follow_button").removeClass('follow');
                $("a#follow_button").addClass('unfollow');
                $("a#follow_button span.ui-btn-text").html('Inceteaza sa mai urmaresti');
            }
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
            if(msg.response=='ok'){
                $(".profile_followers h3 a").html(msg.followers);
                $("a#follow_button").removeClass('unfollow');
                $("a#follow_button").addClass('follow');
                $("a#follow_button span.ui-btn-text").html('Urmareste');
            }
        }
    })
}

$(function(){
    $("a.like_wrap").on('tap', function(e){
        e.preventDefault();
        var id=$(this).parent().parent().attr('id');
        like(id);
    })

    $(".submit-register").on('tap', function(e){
        e.preventDefault();
        var name=$("#register_name").val();
        var email=$("#register_email").val();
        var pass=$("#register_password").val();
        var pass2=$("#register_password2").val();
        if(name != "" && email != "" && pass != "" && pass2 != ""){
            register(name, email, pass);
        }else{
            alert("Nu ai completat toate campurile");
        }
    })
    $("#reg_again").on('tap', function(e){
        e.preventDefault();
        $("#register section#register_resp").fadeOut();
        $("#register section.reg_form").fadeIn();
    })
    $(".footer_nav a").on('tap', function(e){
        e.preventDefault();
        var page=$(this).attr('id');
        $.mobile.changePage( "#"+page, {
            transition: "fade"
        } );
    })
    $(".submit-log-in").on("tap", function(e){
        e.preventDefault();
        if($("#log_email").val() != "" && $("#log_pass").val() != ""){
            var the_email=$("#log_email").val();
            var the_pass=$("#log_pass").val();
            login(the_email, the_pass);
        }else{
            alert ("Nu ai completat toate campurile");
        }
    })
    $(".submit-log-out").on("tap", function(e){
        e.preventDefault();
        logout();
    //$("form[name=logout]").submit();
    })
    $("#options form[name='news_options'] a").on("tap", function(e){
        e.preventDefault();
        var opt= $(this).attr('id');
        $("#options #page_opt").val(opt);
        $("#options form[name='news_options']").submit();
    })
    $("#categories form[name='news_categories'] a").on("tap", function(e){
        e.preventDefault();
        var opt= $(this).attr('id');
        $("#categories #news_cat").val(opt);
        $("#categories form[name='news_categories']").submit();
    })
    
    $("a.read_more_wrap").on("tap", function(e){
        e.preventDefault();
        var the_id=$(this).parent().parent().attr('id');
        $("input#the_news_id").val(the_id);
        $("form[name=news_link]").submit();
    })
    $("a.other_user").on("tap", function(e){
        e.preventDefault();
        var the_id=$(this).attr('id');
        $("input#the_user_id").val(the_id);
        $("form[name=user_link]").submit();
    })
    $("a.foll_user_link").on("tap", function(e){
        e.preventDefault();
        var the_id=$(this).attr('id');
        $("input#the_multi_user_id").val(the_id);
        $("form[name=multi_user_link]").submit();
    })
    
    $("#submit_comment").on("tap", function(e){
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
    $("input.search_text").keyup(function(){
        if($(this).val()!=""){
            search($(this).val());
            
        }else{
            $(".search_results").html('Nu ai introdus nici un termen de cautat..');
        }
        
    });
    $("a.read_more_search").live("tap", function(e){
        e.preventDefault();
        var the_id=$(this).parent().parent().attr('id');
        $("input#search_the_news_id").val(the_id);
        $("form[name=search_news_link]").submit();
    })
    $("a.active_share").on('tap', function(e){
        e.preventDefault();
        var the_news_id=$(this).parent().parent().attr('id');
        share(the_news_id);
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
    $("form[name=follow_form] a").on("tap", function(){
        var the_user_type=$(this).attr('id');
        $("input#user_type").val(the_user_type);
        $("form[name=follow_form]").submit();
    })
    
})


