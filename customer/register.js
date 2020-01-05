    // $('#next').on('click',function(){

    //   $('.loginSuccess').css('display','inline');
    // });


    $('#Email').focusout(function(){
        var email = $('#Email').val();
        if(email.trim() != ''){
            $.post('emailValid.php',{email: email}, function(data){
                $('#emailValid').html(data);
            }); 
        }else {
            $('#emailValid').html('') ;
        }
    });

    var currentPage =0;

    function dot() {
      var x = document.getElementsByClassName("dot");
      for (i = 0; i < x.length; i++) {
        x[i].style.background = "white";
        x[i].style.color = "black";
      }
      x[currentPage].style.background = "black";
      x[currentPage].style.color = "white";
    }
    // function showPassword() {
    //         var pass = document.getElementById("myPass");
    //         if(pass.type === "password"){
    //             pass.type = "text";
    //         } else {
    //             pass.type = "password";
    //         }
    //     }
    function displayButton(count) {
      var prev = document.getElementById("prev");
      var next = document.getElementById("next");

      if (count == 0) {
        prev.style.display = "none";
      } else if (count == 3) {
        prev.style.display = "inline";
        next.value = "Submit";
      } else {
        next.value = "Next";
        prev.style.display = "inline";
      }
    }

    function confirmPassword() {
      var pass = document.getElementById("myPass").value;
      var check = document.getElementById("confPass").value;
      if (check != "") {
        if (pass != check) {
          document.getElementById("confPass").style.border = "1px solid red";
          document.getElementById("confPass").style.background = "#F5B7B1";
        } else {
          document.getElementById("confPass").style.border = "1px solid green";
          document.getElementById("confPass").style.background = "#D5F5E3";
        }
      }
    }

    function submitPassword() {
      var pass = document.getElementById("myPass").value;
      var check = document.getElementById("confPass").value;
      var x = 0;
      var emailValid = document.getElementById("emailValid").textContent;
      if(emailValid == 'This email was registered.'){
          alert("Sorry, your email was registered please try again.");
          x = 1;
      }
      if (pass != check) {
        alert("Sorry, your password is incorrect please try again.");
        x = 1;
      }
      if( x == 1) return 0;
      else return 1;
    }

    function display(n) {
      var x = document.getElementsByClassName("tab");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[n].style.display = "block";
    }

    function validForm(n) {
      if (submitPassword() == 0) {
        display(n);
        return false;
      } else if (chgColor(n) == false) {
        display(n);
        return false;
      } else {
        currentPage += 1;
        if (n == 3) document.getElementById("registerForm").submit();
        else display(n + 1);
        return true;
      }
    }

    function chgColor(n) {
      var x = document.getElementsByClassName("tab");
      if (n == 2) var y = x[n].getElementsByTagName("textarea");
      else var y = x[n].getElementsByTagName("input");
      var isNull = true;
      var length = y.length;
      for (j = 0; j < length; j++) {
        if (checkInput(n, j) == false) {
          isNull = false;
          y[j].style.background = "#F5B7B1";
        }
      }
      return isNull;
    }

    function checkInput(n, i) {
      var x = document.getElementsByClassName("tab");
      if (n == 2) var y = x[n].getElementsByTagName("textarea");
      else var y = x[n].getElementsByTagName("input");
      if (trimfield(y[i].value) != "") {
        y[i].style.background = "#F8F9F9";
        y[i].style.border = "1px solid #CACFD2";
        return true;
      } else {
        return false;
      }
    }

    function trimfield(str) {
      return str.replace(/^\s+|\s+$/g, "");
    }

    