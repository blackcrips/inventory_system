$(document).ready(function () {
  let signupFields = $("[data-signup]");
  let loginButton = $("#login");

  let stopMe = "";
  loginButton.on("click", function (e) {
    signupFields.each(function () {
      if ($(this).val() == "") {
        $(this).css("border", "2px solid red");
        stopMe = 1;
      }
    });
    if (stopMe != "") {
      stopMe = "";
      alert("Invalid Data");
    }

    if ($("[data-signup]")[4].value != $("[data-signup]")[5].value) {
      alert("Password not match!");
    } else {
      $("#form-signup").submit();
    }
  });
});
