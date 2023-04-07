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

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawCharts);

function drawCharts(){
    drawRegistration();
    drawPostType();
    drawComment();
}

function drawRegistration(){
    fetch("admin/registData.php").then(response => response.json()).then(data =>{
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', 'Registration Date');
        dataTable.addColumn('number', 'Number of Users');
        dataTable.addRows(data);

        var options = {
            title: 'Number of Users Registered Over Time',
            legend: { position: 'bottom'}, hAxis: {title: 'Date'}, vAxis: {title: 'Number of Users'},
            width:  800,
            height: 400
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(dataTable, options);
    }
    );

}

function drawPostType(){
    fetch("admin/typeData.php").then(response => response.json()).then(data =>{
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string','Post Type');
        dataTable.addColumn('number','Number of Posts');
        dataTable.addRows(data);

        var options={
            title: "Posts distribution by Post Type",
            legend:{position: 'bottom'}, width: 800, height: 400
        };
        var chart = new google.visualization.PieChart(document.getElementById('postChart'));
        chart.draw(dataTable, options);
    })
}
function drawComment(){
    fetch("admin/commentData.php").then(response => response.json()).then(data=>{
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string','Post Type');
        dataTable.addColumn('number','Number of Posts');
        dataTable.addRows(data);

        var options={
            title: "Comment Activity",
            legend:{position: 'bottom'},hAxis: {title:'Date'}, vAxis:{title: 'Number of Comments'}, width: 800, height: 400
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('commentChart'));
        chart.draw(dataTable, options);
    });
}