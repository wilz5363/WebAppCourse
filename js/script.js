/**
 * Created by Wilson on 5/20/2016.
 */
$(document).ready(function () {
    $("#passageContent").change(function () {
        $("#passageUpdateBtn").removeAttr("disabled");
    });

    $("#passwordForm").on('submit', function (e) {

        e.preventDefault();
        var oPassword = $("#oldPassword").val().trim(), nPassword = $("#newPassword").val().trim(), cPassword = $("#confirmPassword").val().trim();
        if (oPassword != "" && nPassword != "" && cPassword != "") {
            if (nPassword != cPassword) {
                alert("Both New Password and Confirm Password must be the same.");
            } else {
                var userConfirm = confirm("Are you sure? You will signed out after changing the password.");
                if (userConfirm) {
                    $.ajax({
                        url: "updatePassword.php",
                        type: "POST",
                        data: $(this).serialize(),
                        success: function (verdict) {
                            if (verdict === "success") {
                                window.location.replace("signout.php");
                            }else{
                                alert(verdict);
                            }
                        }, fail: function () {
                            alert("update failed");
                        }

                    });
                }
            }
        } else {
            alert("Input must contain values.");
        }
    });
});