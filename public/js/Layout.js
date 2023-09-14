let menu = document.querySelector(".menu-burger");
let spanTop = document.querySelector("#top");
let spanMid = document.querySelector("#mid");
let spanBot = document.querySelector("#bot");
let links = document.querySelector(".links")

menu.addEventListener("click", menuburger);

function menuburger() {

    if (menu.classList[1] != "open"){

        menu.classList.add("open");
        spanMid.style.display = "none";
        spanBot.style.marginTop = "-5px";
        spanBot.style.transform = "rotate(45deg)";
        spanTop.style.transform = "rotate(-45deg)";
        links.style.display = "flex";

    }

    else {

        spanMid.style.display = "block";
        spanBot.style.marginTop = "5px";
        spanBot.style.transform = "rotate(0deg)";
        spanTop.style.transform = "rotate(0deg)";
        menu.classList.remove("open");
        links.style.removeProperty("display");
    }
}
