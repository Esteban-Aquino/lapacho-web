<?php
    require_once '../../model/Token.php';
    require  '../../config/parametros.php';
    require '../../shared/php-jwt-master/src/JWT.php';
    require  '../../shared/util.php';

    $token = new Token();

    echo $token->validarToken('eyJ0eXAiOiJKV1QiLCJhbDSGciOiJIUzI1NiJ9.eyJVU1VBUklPIjoiQURNSU4iLCJOT01CUkUiOiJBRE1JTklTVFJBRE9SIERFTCBTSVNURU1BIiwiRU1JIjoiMTJcLzA4XC8yMDIxIDE5OjE0OjMyIiwiVkVOQyI6IjEzXC8wOFwvMjAyMSAwMToxNDozMiJ9.nc8sB-D023RFpBzte7CS5N5aKRIcr9jUp75Kd6u0DDQ');