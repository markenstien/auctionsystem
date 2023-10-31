<?php 
function liveStatus($status){
    if($status == 0){
        return '<span class="text-secondary">Not Live</span>';
    }
    if($status == 1){
        return '<span class="text-danger">Deleted</span>';
    }
    if($status == 2){
        return '<span class="text-primary">Live</span>';
    }

    if ($status == 3){
        return '<span class="text-success">Live ended</span>';
    }
}

function getSingle($conn, $sql = '') {
    return getList($conn, $sql)[0] ?? false;
}

function getList($conn, $sql = '') {
    $retVal = [];
    if(!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $retVal[] = $row;
        }
    }

    return $retVal;
}

function dbexecute($conn, $sql) {
    $query = $conn->query($sql);
    return [
        $query,
        $conn
    ];
}

function dump($data) {
    echo '<pre>';
        var_dump($data);
    echo '</pre>';
    die();
}