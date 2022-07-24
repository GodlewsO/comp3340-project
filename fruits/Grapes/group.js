$(function(){
    //Hide all sublists
    $(".sublist").hide();
    //Show Shop sublist when hovered
    $(".shop-nav").hover(function (event){
        $(".shop-sub").slideDown(750);

    }, function (event){
        $(".shop-sub").slideUp(300);
    });
    //Show Partner sublist when hovered
    $(".partners-nav").hover(function (){
        $(".partners-sub").slideDown(750);

    }, function (){
        $(".partners-sub").slideUp(300);
    });
//Toggle showing nav bar on mobile devices. Also toggles aria-expanded for screen readers
    $(".mobile-nav-toggle").on("click", function(){
        if ($(".nav-list").attr("data-visible")=="false"){
            $(".nav-list").attr("data-visible", "true");
            $(this).attr("aria-expanded", "true");
        } else {
            $(".nav-list").attr("data-visible", "false");
            $(this).attr("aria-expanded", "false");
        }
    });

});