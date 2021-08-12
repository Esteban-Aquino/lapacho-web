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
        $this->_responseData['acceso'] = $this->_access;
        $this->_responseData['datos'] = $this->_data;
        $this->_responseData['token'] = $this->_token;
        $this->_responseData['mensajes'] = $this->_messages;
        IF (!HTTP_ERRORS) {
            $this->_httpStatusCode = StatusCodes::HTTP_OK;
        }
        http_response_code($this->_httpStatusCode);
        echo json_encode($this->_responseData);
    }
}
