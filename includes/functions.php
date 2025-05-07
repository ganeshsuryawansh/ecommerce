<?php


function add_order($pid, $email, $qt)
{
    global $conn;

    $tk = $pid . "_" . $email;
    // $qr = "INSERT INTO myorders (productid, email_id, quantity,token) VALUES (?,?,?,?)";
    // $stmt = mysqli_prepare($conn, $qr);

    // if ($stmt) {
    //     mysqli_stmt_bind_param($stmt, "isis", $pid, $email, $qt, $tk);

    //     $result = mysqli_stmt_execute($stmt);
    //     mysqli_stmt_close($stmt);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // } else {
    //     return false;
    // }


    $qr = "INSERT INTO myorders(productid, email_id, quantity,token) VALUES('$pid','$email','$qt','$tk')";

    $result = mysqli_query($conn, $qr);

    if ($result) {
        return true;
    } else {
        return false;
    }
}


function date_more_5_day($date)
{
    $currentDate = $date;

    $date = new DateTime($currentDate);
    $interval = new DateInterval('P5D');
    $date->add($interval);
    $newDate = $date->format('Y-m-d');

    return $newDate;
}

function add_payment($pid, $email, $price, $trnid)
{
    global $conn;

    $qr = "INSERT INTO payments (pid, email, price,trnid) VALUES (?, ?, ?,?)";
    $stmt = mysqli_prepare($conn, $qr);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "isis", $pid, $email, $price, $trnid);

        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
