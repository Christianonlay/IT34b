
<?php
//Start user session
function startUserSession($pdo)
{
    if (!isset($_SESSION['user_id'])) {
        return false;
    }

    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("
        INSERT INTO user_sessions (
            user_id,
            session_start
        )
        VALUES (
            :user_id,
            NOW()
        )
    ");
    $stmt->execute([
        'user_id' => $user_id
    ]);
    return $pdo->lastInsertId();

}
 
// end user session
function endUserSession($pdo){

    if(!isset($_SESSION['session_id'])){
        return false;

    }
    $Session_id = $_SESSION['session_id'];

    $stmt = $pdo->prepare("
        UPDATE user_sessions
        SET

        session_end = NOW(),
        session_duration = TIMESTAMPDIFF(
        SECOND,
        session_start,
        NOW()
        )
        WHERE session_id = :session_id
    ");
     return $stmt -> execute([
        'session_id'=> $session_id
     ]);
}

?>
