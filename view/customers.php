<?php
require_once '../helpers/helpers.php';

$layout = 'master';
$title = 'Customers';

?>

<div class="center">
    <?php
    if (!empty($customers)) {
        foreach($customers as $customer){
            echo "<a class='link' href='/customer/" . $customer['id']. "'>";
            echo "<div>Имя " .  $customer['name'] . "</div>";
            echo "<div>Количество книг " .  $customer['count_book'] . "</div>";
            echo "</a>";
        }
    } else {
        echo "Список пустой";
    }

    ?>
</div>