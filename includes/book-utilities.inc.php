<?php

function readCustomers($filename) {
    $customers = [];

    if (($file = fopen($filename, "r")) !== false) {
        while (($line = fgetcsv($file, 1000, ";")) !== false) {

            if (count($line) >= 12) {
                $customers[] = [
                    "id" => $line[0],
                    "firstName" => $line[1],
                    "lastName" => $line[2],
                    "email" => $line[3],
                    "university" => $line[4],
                    "address" => $line[5],
                    "city" => $line[6],
                    "state" => $line[7],
                    "country" => $line[8],
                    "zip" => $line[9],
                    "phone" => $line[10],
                    "sales" => $line[11]
                ];
            }
        }
        fclose($file);
    }

    return $customers;
}

function readOrders($customerID, $filename) {
    $orders = [];

    if (($file = fopen($filename, "r")) !== false) {
        while (($line = fgetcsv($file, 1000, ",")) !== false) {

            if (count($line) >= 5 && $line[1] == $customerID) {
                $orders[] = [
                    "orderID" => $line[0],
                    "isbn" => $line[2],
                    "title" => $line[3],
                    "category" => $line[4]
                ];
            }
        }
        fclose($file);
    }

    return $orders;
}