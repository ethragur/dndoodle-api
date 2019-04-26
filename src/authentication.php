<?php


function createUserNormal($username, $password, $db)
{
    $stmt = $db->prepare("INSERT INTO dnd_user(user_name, user_pass) VALUES(:username, :password)");

    if($stmt->execute(["username" => $username, "password" => password_hash($password, PASSWORD_DEFAULT) ]) )
    {
        return true;
    }
    else
    {
        throw new UserDuplicateException("User already exists");
    }
}

function createUserGoogle($username, $gauthID, $db)
{
    $stmt = $db->prepare("INSERT INTO dnd_user(user_name, user_gid) VALUES(:username, :gid)");

    if($stmt->execute(["username" => $username, "gid" => $gauthID ]) )
    {
        return true;
    }
    else
    {
        throw new UserDuplicateException("User already exists");
    }
    
}

function checkAuthNormal($username, $password, $db)
{
    $stmt = $db->prepare("SELECT user_id, user_name, user_pass FROM dnd_user WHERE user_name = :username LIMIT 1");

    $stmt->execute(["username" => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user == false)
    {
        throw new InvalidLoginException("Cannot find user: " . $username);
    }
    else
    {
        if( password_verify($password, $user["user_pass"] ) )
        {
            return $user;
        }
        else
        {
            throw new InvalidLoginException("Password Invalid");
        }
    }
}

function checkAuthGoogle($gauthID, $db)
{
    $stmt = $db->prepare("SELECT user_id, user_name, user_gid FROM dnd_user WHERE user_name = :username LIMIT 1");

    $stmt->execute(["username" => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user == false)
    {
        throw new InvalidLoginException("Cannot find user: " . $username);
    }
    else
    {
        if( $gauthID == $user["user_gid"] )
        {
            return $user;
        }
        else
        {
            throw new InvalidLoginException("Password Invalid");
        }
    }
}

function createJWT($user)
{
      $now = new DateTime();
      $future = new DateTime("now +1 week");

      $payload =
	 [
	    "iat"       => $now->getTimeStamp(),
	    "exp"       => $future->getTimeStamp(),
	    "una"       => $user["user_name"],
	    "uid"       => $user["user_id"]
	 ];

      $token = JWT::encode($payload, Config::$jwtauth_settings["secret"], "HS256");

      return $token;
}


?>
