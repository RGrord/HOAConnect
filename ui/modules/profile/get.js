$(document).ready(function() {
  $.ajax({
    url: "/hoa_system/app/api/profile/get.profile.php",
    type: "GET",
    dataType: "json",
    success: function(res) {
      if (res.data) {
        const user = res.data;

        $("#userName").text(user.first_name + ' ' + user.last_name);
        $("#userRole").text(user.role);
        // $("#userAvatar").attr("src", user.avatar);

        $("#dropdownUserName").text(user.fullName);
        $("#dropdownUserEmail").text(user.email);
        // $("#dropdownUserAvatar").attr("src", user.avatar);
      } else {
        console.warn("User not found or unauthorized:", res.message);
      }
    },
    error: function(xhr, status, error) {
      console.error("Error fetching user data:", error);
    }
  });
});


