function openMenu() {
    document.getElementById("menu").style.left = "0";
    document.getElementById("overlay").classList.add("active");
    document.getElementById("map").classList.add("inactive");
}

function closeMenu() {
    document.getElementById("menu").style.left = "-250px";
    document.getElementById("overlay").classList.remove("active");
    document.getElementById("map").classList.remove("inactive");
}
