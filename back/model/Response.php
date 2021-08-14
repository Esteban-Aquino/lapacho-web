<?php
class Response
{
    private $_access;
    private $_httpStatusCode;
    private $_messages = array();
    private $_data;
    private $_token;
    private $_toCache = false;
    private $_responseData = array();

    public function __construct()
    {
        
    }

    public function setAccess($_access)
    {
        $this->_access = $_access;
    }

    public function setToken($token)
    {
        $this->_token = $token;
    }

    public function setHttpStatusCode($httpStatusCode)
    {
        $this->_httpStatusCode = $httpStatusCode;
    }

    public function addMessage($message)
    {
        $this->_messages[] = $message;
    }

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function toCache($toCache)
    {
        $this->_toCache = $toCache;
    }

    public function send()
    {
        agrega_cabecera_json($this->_toCache);
        $this->_responseData['acceso'] = nvl($this->_access,false);
        $this->_responseData['datos'] = $this->_data;
        $this->_responseData['token'] = nvl($this->_token,'');
        $this->_responseData['mensajes'] = $this->_messages;
        IF (!HTTP_ERRORS) {
            $this->_httpStatusCode = StatusCodes::HTTP_OK;
        }
        http_response_code($this->_httpStatusCode);
        echo json_encode($this->_responseData);
    }

    public function sendMethodNotFound()
    {
        agrega_cabecera_json($this->_toCache);
        $this->_responseData['acceso'] = nvl(Token::getAccess(),false);
        $this->_responseData['datos'] = '';
        $this->_responseData['token'] = nvl(Token::getToken(),'');
        $this->addMessage('Metodo no admitido');
        $this->_responseData['mensajes'] = $this->_messages;
        IF (!HTTP_ERRORS) {
            $this->_httpStatusCode = StatusCodes::HTTP_OK;
        }
        http_response_code(StatusCodes::HTTP_METHOD_NOT_ALLOWED);
        echo json_encode($this->_responseData);
    }

    public function sendServiceNotFound()
    {
        agrega_cabecera_json($this->_toCache);
        $this->_responseData['acceso'] = nvl(Token::getAccess(),false);
        $this->_responseData['datos'] = '';
        $this->_responseData['token'] = nvl(Token::getToken(),'');
        $this->addMessage('No se encuentra servicio solicitado');
        $this->_responseData['mensajes'] = $this->_messages;
        IF (!HTTP_ERRORS) {
            $this->_httpStatusCode = StatusCodes::HTTP_OK;
        }
        http_response_code(StatusCodes::HTTP_NOT_FOUND);
        echo json_encode($this->_responseData);
    }

    
}
