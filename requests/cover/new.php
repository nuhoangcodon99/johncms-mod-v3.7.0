<?php
if (isset($_FILES['image']['tmp_name']))
{
    $coverImage = $_FILES['image'];
    $timelineId =  $_POST['timeline_id'];
        $coverData = registerCoverImage($coverImage);
        
        if (isset($coverData['extension']))
        {
            $query = mysql_query("UPDATE `users` SET cover_extension='" . $coverData['extension'] . "',cover_position=0 WHERE id=" . $timelineId);

            if ($query)
            {
                $data = array(
                    'status' => 200,
                    'cover_url' => $home . '/' . $coverData['cover_url'],
                    'actual_cover_url' => $home . '/' . $coverData['url']. '.' . $coverData['extension']
                );
            }
        }
    
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($data);
    exit();
}