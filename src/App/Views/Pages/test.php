<?php
foreach ($users as $user)
{ ?>
ID: <?= $user->ID; ?>
Name: <?= $user->Name; ?>
Password: <?= $user->Password; ?>
Email: <?= $user->Email; ?>
<?php
}
?>