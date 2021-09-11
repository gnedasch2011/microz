<?php

use app\models\booking\Rooms;

?>
    <a href="/booking/room-search">Вернуться к поиску</a>

    <h1>Успешная бронь (<?= Rooms::returnName($newReserv->type_rooms); ?>):
        №<?= $newReserv->id; ?></h1>

<?php echo "<pre>";
print_r($newReserv->attributes); ?>
<?php echo "<pre>";
print_r($newReserv->client->attributes); ?>