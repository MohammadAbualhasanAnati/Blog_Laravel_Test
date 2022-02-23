$(document).ready(function(){
    collapsibleSideMenu();
    events();
})

let events=()=>{
    $("#logoutBtn").click(()=>{
        $("#logoutForm").submit()
    })
}

let collapsibleSideMenu=()=>{
    $('.sub-menu ul').hide();
    $(".sub-menu a").click(function () {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });
}