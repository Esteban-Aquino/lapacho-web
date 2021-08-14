<?php
    /**
     * Aqui se debe fijar las rutas a los controladores
     * @author Esteban Aquino
     */
    Router::addGet('test','TEST_CONTROLLER.PHP','getHola');

    // Validar Usuario
    Router::addPost('auth','AUTH_CONTROLLER.PHP','loggin', false);

    //Clubes
    Router::addGet('clubes','CLUBES_CONTROLLER.php', 'get');
    Router::addPost('clubes','CLUBES_CONTROLLER.php', 'post');
    Router::addPut('clubes','CLUBES_CONTROLLER.php', 'put');
    Router::addDelete('clubes','CLUBES_CONTROLLER.php', 'delete');