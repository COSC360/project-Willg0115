window.onload = init;
function init(){
    const form = document.getElementById("createForm"); 
    const requiredFields = form.getElementsByClassName("required");
    console.log(requiredFields)
    form.addEventListener('submit', function(event) {
        //check for blank required fields
        var empty = false;
        for (var i = 0; i < requiredFields.length; i++) {
            //if blank fields exist prevent submission
            if (requiredFields[i].value == '' || requiredFields[i].value == null){
                empty = true;
            }
        }
        if(empty){
            event.preventDefault();
            //assing appropriate blank fields css class for red error styling
            for (var i = 0; i < requiredFields.length; i++) {
                var field = requiredFields[i];
                if (field.value == '' || field.value == null) {
                  field.classList.add('error');
                } else {
                  field.classList.remove('error');
                }
            }
            alert('Please fill in all fields');
        }   
        //make sure passwords match
        var pass = form.querySelector('input[name=password]');
        var confirm = form.querySelector('input[name=confirm]');
        if(pass.value != confirm.value){
            event.preventDefault();
            alert('Passwords must match!');
            confirm.classList.add('error');
            pass.classList.add('error');
        }
    }); 
    //listner for changed fields
    for (let i = 0; i < requiredFields.length; i++) {
        requiredFields[i].addEventListener("change", function(event) {
                requiredFields[i].classList.remove('error');
        });
    } 
}