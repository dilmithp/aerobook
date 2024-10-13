<?php
include_once 'header.php';
include_once 'includes/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Booking - AreoBook</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
        }

        main {
            padding: 40px 20px;
            background-color: #f0f4f8;
            max-width: 1200px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
            letter-spacing: 1.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2d72d9;
            color: white;
            font-size: 18px;
            letter-spacing: 1px;
        }

        td {
            font-size: 16px;
            color: #333;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .manage-btn {
            padding: 10px 15px;
            font-size: 14px;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 5px;
            display: inline-block;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s ease;
        }

        .update-btn {
            background-color: #28a745;
        }

        .update-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }


        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th,
            td {
                padding: 10px;
                font-size: 14px;
            }

            tr {
                margin-bottom: 20px;
            }

            th {
                background-color: #2d72d9;
            }
        }
    </style>
    <script>
        function confirmDelete(booking_id) {
            if (confirm("Are you sure you want to delete this booking?")) {

                window.location.href = 'delete_booking.php?booking_id=' + booking_id;
            }
        }
    </script>
</head>

<body>

    <main>
        <h1>Manage Booking</h1>

        <?php

        $sql = "SELECT fid, origin, destination, price FROM managebook";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                <thead>
                    <tr>
                        <th>Flight ID (FID)</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";


            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['fid']}</td>
                    <td>{$row['origin']}</td>
                    <td>{$row['destination']}</td>
                    <td>{$row['price']}</td>
                    <td>
                        <a href='modify_booking.php?booking_id={$row['fid']}' class='manage-btn update-btn'>Update</a>
                        <span class='manage-btn delete-btn' onclick='confirmDelete({$row['fid']})'>Delete</span>
                    </td>
                  </tr>";
            }

            echo "</tbody></table><br><botton class='manage-btn update-btn'><a href=\"add_booking_form.php\" style=\"color:black;\">Add Booking</a></botton>";
        } else {
            echo "<p>No bookings found.</p>";
        }
        ?>

    </main>

</body>

</html>