$(document).ready(function() {
    $("#login").click(function() {
        var id = $("#id").val();
        var password = $("#psw").val();
        if(id == '' || password == '') {
            alert("Please fill the form");
        } else {
            login(id, password);
        }
    })
});

function ajaxlogin(id,password){
    return $.post("php/login_staff.php", {
        staffId : id,
        password : password
    })
}

function login(id, password) {
    $.when(ajaxlogin(id,password)).then(function(data) {
        if(data == 'Staff ID is NOT FOUND!'){
            alert(data);
        } else if(data == 'Password is NOT CORRECT!!'){
            alert(data);
        } else {
            switch (data) {
                case "SA":
                    location.replace("sa_home.html");
                    break;
                case "AE":
                    location.replace("ae_home.html");
                    break;
                case "CEO":
                    location.replace("ceo_home.html");
                    break;
            }
        }
    });
}