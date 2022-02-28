<?php
require_once '../helpers/helpers.php';

$layout = 'master';
$title = 'Customer';

?>

<div class="center">
    <?php
    if (!empty($customer)) {
        $sex = (int)$customer['gender'] === 1 ? 'Муж' : 'Жен';

        echo "<div>Имя " . $customer['customer_name'] . "</div>";
        echo "<div>Пол " . $sex . "</div>";
        echo "<div>Дата рождения " . $customer['date'] . "</div>";
    } else {
        echo "Нет такого клиента";
    }
    ?>
</div>
