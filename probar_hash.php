<?php
$hash_profesor = '$2y$10$xOm9g9YAuyZjzmQ/3C1fgO/U2zSfVjIJc5n/LdFv9NVeMGvdXOEHO';
var_dump(password_verify("profe", $hash_profesor)); // debe ser true
?>
