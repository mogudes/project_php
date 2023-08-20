var category_btn = document.getElementById("category-btn");
var recentNews_btn = document.getElementById("recentNews-btn");

var category_content = document.getElementById("categoryEdit");
var recentNewsEdit_content = document.getElementById("recentNewsEdit");

var menuBtn = document.getElementById("admin-menu");
var menu = document.getElementById("side-navbar");

var confirmationPage = document.getElementById("confirmationPage");
var closeConfirmation = document.getElementById("closeConfirmation");
var yesBtn = document.getElementById("yes");
var noBtn = document.getElementById("no");
var submitBtn=document.getElementsByClassName("submit");
var submitEvent=document.getElementById("realSubmitEvent");
var submitNews=document.getElementById("realSubmitNews");



closeConfirmation.addEventListener("click", closeConfirmationPage);
noBtn.addEventListener("click", closeConfirmationPage);
for(var i=0; i<2; i++){
    submitBtn[i].addEventListener("click", closeConfirmationPage);


}
yesBtn.addEventListener("click", submitFunction);


recentNewsEdit_content.style.display = "none";
category_content.style.display = "block";
category_btn.style.backgroundColor = "var(--darker_theme)";
recentNews_btn.style.backgroundColor = "var(--theme)";

window.addEventListener('load',function(){
    if(this.window.innerWidth > 640){
        menu.style.display = "block";
    }else {
        menu.style.display = "none";
    }
})

window.addEventListener('resize',function(){
    if(this.window.innerWidth > 640){
        menu.style.display = "block";
    }else {
        menu.style.display = "none";
    }
})
confirmationPage.style.display = "none";

category_btn.addEventListener("click", displayCategory);
recentNews_btn.addEventListener("click", displayRecentNews);
menuBtn.addEventListener("click", displayMenu);

function submitFunction(){
    if(category_content.style.display!="none"){
        submitEvent.click();
    }else if(recentNewsEdit_content.style.display != "none"){
        submitNews.click();
    }
}


function displayCategory() {
    if (category_content.style.display == "none") {
        category_content.style.display = "block";
        recentNewsEdit_content.style.display = "none";
        category_btn.style.backgroundColor = "var(--darker_theme)";
        recentNews_btn.style.backgroundColor = "var(--theme)";

    }
}
function displayRecentNews() {
    if (recentNewsEdit_content.style.display == "none") {
        recentNewsEdit_content.style.display = "block";
        category_content.style.display = "none";
        recentNews_btn.style.backgroundColor = "var(--darker_theme)";
        category_btn.style.backgroundColor = "var(--theme)";


    }
}

function displayMenu() {
    if (menu.style.display == "none") {
        menu.style.display = "block";
    } else if (menu.style.display == "block") {
        menu.style.display = "none";
    }

}

function closeConfirmationPage() {
    if (confirmationPage.style.display == "none") {
        confirmationPage.style.display = "block";


    } else if (confirmationPage.style.display == "block"){
        confirmationPage.style.display = "none";

    }

}

