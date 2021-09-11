<?php

use app\models\booking\Rooms;

?>
    <h1>Успешная бронь (<?= Rooms::returnName($newReserv->type_rooms); ?>):
        №<?= $newReserv->id; ?></h1>

<?php echo "<pre>";
print_r($newReserv->attributes); ?>
<?php echo "<pre>";
print_r($newReserv->client->attributes); ?>