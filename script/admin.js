function showSection(id){
    var sections = document.getElementsByClassName("section");
    for(var i =0; i<sections.length; i++){
        sections[i].style.display = "none";
    }
    document.getElementById(id).style.display="block";
}

// async function searchUsers(event) {
//     event.preventDefault();
//     const searchInput = document.getElementById('searchUser').value;
//     const response = await fetch('searchuser.php', {
//         method: 'POST',
//         body: new URLSearchParams({ 'search': searchInput }),
//     });
//     const results = await response.text();
//     document.getElementById('searchResults').innerHTML = results;
// }
// function stateSubmit(formId) {
//     let form = document.getElementById(formId);
//     form.submit();
//   }