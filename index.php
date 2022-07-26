<?php

switch($_GET['url']){
    case 'service_ip': exit(require_once('service_ip.php'));
    case 'contacts': exit(require_once('contacts.php'));

    default: exit(require_once('error404.php'));
}

