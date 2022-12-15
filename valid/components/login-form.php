<?php
session_start();

require_once './inc/functions.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = InputProcessor::process_email($_POST['email'] ?? '');
    $password = InputProcessor::process_password($_POST['password'] ?? '');

    $valid = $email['valid'] && $password['valid'];

    if ($valid) {
       
      $user = $controllers->members()->login($email['value'], $password['value']);

      if (!$user) {
          $message = "Incorrect password and/or username";
      }
      else {
          $_SESSION['username'] = $user['firstname'] .' '. $user['lastname'];
          redirect('member');
      }
      
    }

    else {
       $message =  "Please fix the above errors. ";
   }

} 
?>

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <h3 class="mb-2">Sign in</h3>  
              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required value="<?= htmlspecialchars($email['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                </div>
  
              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required value="<?= htmlspecialchars($password['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $password['error'] ?? '' ?></span>
                </div>
  
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Login</button>
              <a class="btn btn-secondary btn-lg w-100" type="submit" href="./register.php" >Not got an account?</a>
              
              <?= isset($_GET['errmsg']) ? $message = $_GET['errmsg'] : '' ?>
              <?= $message ? alert($message, 'danger') : '' ?>
      
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>