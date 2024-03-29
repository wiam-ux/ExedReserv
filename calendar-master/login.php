
<?php
    //start PHP session
    session_start();
  
    //check if login form is submitted
    if(isset($_POST['login'])){
        //assign variables to post values
        $email = $_POST['email'];
        $password = $_POST['password'];
  
        //include our database connection
        include 'connect.php';
  
        //get the user with email
        $stmt = $bdd->prepare('SELECT * FROM users WHERE email = :email');
  
        try{
            $stmt->execute(['email' => $email]);
  
            //check if email exist
            if($stmt->rowCount() > 0){
                //get the row
                $user = $stmt->fetch();
  
                //validate inputted password with $user password
                if(password_verify($password, $user['password'])){
                    //action after a successful login
                    $_SESSION['success'] = 'User verification successful';
                    header("Location: index.php");
                    exit(); // Make sure to exit to prevent further script execution
                }
                else{
                    //return the values to the user
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
  
                    $_SESSION['error'] = 'Incorrect password';
                }
  
            }
            else{
                //return the values to the user
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
  
                $_SESSION['error'] = 'No account associated with the email';
            }
  
        }
        catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }
  
    }
    else{
        $_SESSION['error'] = 'Fill up login form first';
    }
  
    header('location: home.php');
?>