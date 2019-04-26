<?php

function getCharacter($id, $db)
{
    $stmt = $db->prepare("SELECT char_id, char_name FROM dnd_char WHERE char_id = :char_id");

    if($stmt->execute(["char_id" => $id ]))
    {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    else
    {
        throw new IDontReallyKnowException("Houston, we got a Problem");
    }
}

function createCharacter($char, $user_id, $db)
{
    $stmt = $db->prepare("INSERT INTO dnd_char(char_id, char_name, user_id) VALUES(UUID(), :char_name, :user_id)");

    if($stmt->execute(["char_name" => $char["charname"], "user_id" => $user_id ]))
    {
        $stmt = $db->prepare("SELECT char_id FROM dnd_char WHERE char_name = :char_name AND user_id = :user_id");
        $stmt->execute(["char_name" => $char["charname"], "user_id" => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    else
    {
        throw new IDontReallyKnowException("Houston, we got a Problem");
    }
}

function getCharacterAttr($id, $db)
{
    $stmt = $db->prepare("SELECT char_data FROM dnd_char WHERE char_id = :char_id");

    if($stmt->execute(["char_id" => $id ]))
    {
        return $stmt->fetchAll();
    }
    else
    {
        throw new IDontReallyKnowException("Houston, we got a Problem");
    }
}

function createCharacterAttr($attr, $id, $db)
{

    $stmt = $db->prepare("UPDATE dnd_char SET char_data = :attr WHERE char_id = :char_id ");

    if($stmt->execute(["attr" => json_encode($attr), "char_id" => $id ]))
    {
        return;
    }
    else
    {
        throw new IDontReallyKnowException("Houston, we got a Problem");
    }
}


?>
