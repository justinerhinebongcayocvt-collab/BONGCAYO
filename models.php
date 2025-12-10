<?php







function insertNewUser($pdo, $username, $password) {

    
    $checkUserSql = "SELECT username FROM user_passwords WHERE username = ?";
    $checkUserSqlStmt = $pdo->prepare($checkUserSql);
    $checkUserSqlStmt->execute([$username]);

    if ($checkUserSqlStmt->rowCount() > 0) {
        $_SESSION['message'] = "User already exists. Please choose a different username.";
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO user_passwords (username, password) VALUES(?, ?)";
    $stmt = $pdo->prepare($sql);
    
    $executeQuery = $stmt->execute([$username, $hashedPassword]);

    if ($executeQuery) {
        $_SESSION['message'] = "Registration successful! You may now log in.";
        return true;
    } else {
        $_SESSION['message'] = "An error occurred during registration.";
        return false;
    }
}


// 
// 
// 
function loginUser($pdo, $username, $password) {
    $sql = "SELECT username, password FROM user_passwords WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]); 

    if ($stmt->rowCount() == 1) {
        $userInfoRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $passwordHashFromDB = $userInfoRow['password']; 

        
        if (password_verify($password, $passwordHashFromDB)) {
            $_SESSION['username'] = $userInfoRow['username'];
            $_SESSION['message'] = "Login successful!";
            return true;
        }
    }
    
    
    $_SESSION['message'] = "Invalid username or password.";
    return false;
}





function getAllUsers($pdo) {
    $sql = "SELECT * FROM user_passwords";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
}


function getUserByID($pdo, $user_id) {
    $sql = "SELECT * FROM user_passwords WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$user_id]);
    
    if ($executeQuery) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return false;
}

?>