<?php
require 'config.php';
header('Location: ' . (current_user() ? 'home.php' : 'login.php'));
exit;
