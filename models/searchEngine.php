<?php

include('../config/database.php');

$value = $_POST['search'];

$sql = "SELECT * FROM s_students WHERE (s_lastName LIKE '%$value%' OR s_firstName LIKE '%$value%')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td style="text-align: center;">
                <?= $row['s_sid'] ?>
            </td>
            <td>
                <?= $row['s_lastName'] ?>, <?= $row['s_firstName'] ?>
            </td>
            <td class="d-grid">
                <button type="button" 
                class="btn btn-sm btn-block btn-success" 
                data-bs-toggle="modal"
                data-bs-target="#view-details">
                    View
                </button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "0 results";
}

$conn->close();