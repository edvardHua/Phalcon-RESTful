<?php
decode_request();

function decode_request()
{
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (!is_array($data)) {
        return;
    }
    
    foreach ($data as $key => $value) {
        $_REQUEST[$key] = $value;
    }
}

set_session_handle($config);

function set_session_handle($config)
{
    require dirname(__DIR__) . '/libs/MemcacheSessionHandle.class.php';

    $sessionHandle = new MemcacheSessionHandle($config);

    session_set_save_handler($sessionHandle);
}