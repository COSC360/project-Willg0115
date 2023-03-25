function showSection(id) {
    var sections = document.getElementsByClassName("section");
    for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = "none";
    }
    document.getElementById(id).style.display = "block";

    localStorage.setItem("active_section", id);
}
document.addEventListener("DOMContentLoaded", function () {
    var active_section = localStorage.getItem("active_section");
    if (active_section) {
        showSection(active_section);
    }
});

