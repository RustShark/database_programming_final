<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="CSS/login_style.css">
</head>

<body>
  <main id="main-holder">
    <h1 id="login-header">Login</h1>
    
    <div id="login-error-msg-holder">
      <p id="login-error-msg">Invalid username <span id="error-msg-second-line">and/or password</span></p>
    </div>
    
    <form id="login-form">
      <input type="text" name="username" id="username-field" class="login-form-field" placeholder="Username">
      <input type="password" name="password" id="password-field" class="login-form-field" placeholder="Password">
      <input type="submit" value="Login" id="login-form-submit">
    </form>

    <script>
      const loginForm = document.getElementById("login-form");
      const loginButton = document.getElementById("login-form-submit");
      const loginErrorMsg = document.getElementById("login-error-msg");

      loginButton.addEventListener("click", (e) => {
        e.preventDefault();
        const username = loginForm.username.value;
        const password = loginForm.password.value;

        if (username === "idmina" && password === "a123456") {
          alert("You have successfully logged in.");
          <?php
            setcookie("id", "idmina", time()+86300, "/");
            setcookie("login_time", time(), time()+86300, "/");
            setcookie("token", md5('a123456'), time()+86300, "/");
          ?>

          location.replace('main.php');
        } else {
          loginErrorMsg.style.opacity = 1;
        }
      })
    </script>
  
  </main>
</body>

</html>