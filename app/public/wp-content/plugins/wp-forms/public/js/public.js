jQuery(document).ready(function ($) {
  $("#register").on("submit", function (e) {
    e.preventDefault();

    //console.log("Registration form submitted");

    $.ajax({
      type: "POST",
      url: wpforms_vars.ajax_url,
      data: $(this).serialize(),
      success: function (response) {
        //console.log("Registration response:", response);
        try {
          response = JSON.parse(response);
        } catch (e) {
          console.error("Failed to parse response JSON:", response);
          alert("An unexpected error occurred. Please try again.");
          return;
        }

        $(".input-group__error-message").text(""); // Clear previous errors

        if (response.success) {
          alert("Registration successful. Redirecting to login page...");
          window.location.href = wpforms_vars.login_url;
        } else {
          if (
            response.errors.email &&
            response.errors.email.includes("Email already exists")
          ) {
            alert("Email already exists. Redirecting to login page...");
            window.location.href = wpforms_vars.login_url;
          }

          // Display errors under respective fields
          for (let key in response.errors) {
            $("#" + key + "-error").text(response.errors[key]);
          }
        }
      },
      //xhr object represents the AJAX request and contains information about the request
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
        alert(
          "An error occurred during the registration process. Please try again."
        );
      },
    });
  });


  //for login 
  $("#login").on("submit", function (e) {
    e.preventDefault();

    //console.log("Login form submitted");

    $.ajax({
      type: "POST",
      url: wpforms_vars.ajax_url,
      data: $(this).serialize(),
      success: function (response) {
        //console.log("Login response:", response);
        try {
          response = JSON.parse(response);
        } catch (e) {
          console.error("Failed to parse response JSON:", response);
          alert("An unexpected error occurred. Please try again.");
          return;
        }

        if (response.success) {
          alert("Login successful. Redirecting to todo list page...");
          window.location.href = wpforms_vars.todo_list_url;
        } else {
          // Display errors under respective fields
          for (let key in response.errors) {
            $("#" + key + "-error").text(response.errors[key]);
          }

          if (
            response.errors.email &&
            response.errors.email.includes("User not registered")
          ) {
            alert("User not registered. Redirecting to register page...");
            window.location.href = wpforms_vars.register_url;
          }
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
        alert("An error occurred during the login process. Please try again.");
      },
    });
  });
});
