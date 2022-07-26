<?php

switch($_GET['url']){
    case 'service_ip':
        exit(require_once('./scripts/service_ip.php'));

    case 'contacts':
        exit(require_once('./scripts/contacts.php'));

    case 'requests_ip':
        exit(require_once('./scripts/requests_ip.php'));

    case 'requests_port':
        exit(require_once('./scripts/requests_port.php'));

    case 'requests_monitoring':
        exit(require_once('./scripts/requests_monitoring.php'));

    default: exit(require_once('./scripts/error404.php'));
}

