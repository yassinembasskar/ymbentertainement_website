
const menu_icon = document.getElementById("menu_icon");
const quit_icon = document.getElementById("quit_icon");
const nav_menu = document.getElementById("nav_menu");
const body = document.getElementsByTagName("body")[0];
const search_article = document.getElementById("search_article");
const quit_search_icon = document.getElementById("quit_search_icon");
const circles = document.getElementsByClassName("circle");
var active_circle = document.getElementsByClassName("active circle");
const main_info = document.getElementById("main_info");
const search_bar = document.getElementsByClassName("search_bar")[0];
const form = document.getElementsByTagName("form");



var index_active_circle = 0;


function show_menu(){
    menu_icon.classList.remove("shown");
    menu_icon.classList.add("hidden");
    quit_icon.classList.remove("hidden");
    quit_icon.classList.add("shown");
    nav_menu.classList.remove("hidden");
    nav_menu.classList.add("shown");
}

function hide_menu(){
    menu_icon.classList.remove("hidden");
    menu_icon.classList.add("shown");
    quit_icon.classList.remove("shown");
    quit_icon.classList.add("hidden");
    nav_menu.classList.remove("shown");
    nav_menu.classList.add("hidden");
    body.style.overflow = "auto";
    
}



function clickCircle(circle_index) {
    if (circle_index != index_active_circle) {
        circles[circle_index].classList.add("active");
        circles[circle_index].classList.remove("not_active");
        circles[index_active_circle].classList.remove("active");
        circles[index_active_circle].classList.add("not_active");
    }
    let transform_times = (-circle_index) * 20;

    main_info.style.transform = "translateX(" + transform_times + "%)";

    index_active_circle = circle_index;
}

/*
setInterval(function auto_slide(){
    if(index_active_circle == 4){
        clickCircle(0);
    } else {
        clickCircle(index_active_circle + 1);
    }
}, 3000);*/

if(document.body.offsetWidth>600){
    document.getElementById("search_place").appendChild(form[0]);
}
/*
let edit_admin = document.getElementsByClassName("edit_admin");


for(var index = 0; index < edit_admin.length; index++) {
    edit_admin[index].onclick = show_inputs(index);
}*/

function show_admin(index){
    shown_index="shown_admin_" + index;
    console.log(shown_index);
    hidden_index = "hidden_admin_" + index;
    console.log(hidden_index);
    shown = document.getElementsByClassName(shown_index);
    hidden = document.getElementsByClassName(hidden_index);
    console.log(shown);
    console.log(hidden);
    for (let i = 0; i < shown.length; i++) {
        shown[i].classList.add("hidden_li");
    }
    for (let i = 0; i < hidden.length; i++) {
        hidden[i].classList.remove("hidden_li");
    }
};

function edit_article(index){
    shown_index="shown_article_" + index;
    console.log(shown_index);
    hidden_index = "hidden_article_" + index;
    console.log(hidden_index);
    shown = document.getElementsByClassName(shown_index);
    hidden = document.getElementsByClassName(hidden_index);
    console.log(shown);
    console.log(hidden);
    for (let i = 0; i < shown.length; i++) {
        shown[i].classList.add("hidden_li");
    }
    for (let i = 0; i < hidden.length; i++) {
        hidden[i].classList.remove("hidden_li");
    }
};

