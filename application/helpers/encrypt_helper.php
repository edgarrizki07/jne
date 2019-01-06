<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function encrypt($id, $key)
{
    $id = base_convert($id, 10, 36);
    $data = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $id, 'ecb');
    $data = bin2hex($data);

    return $data;
}

function decrypt($encrypted_id, $key)
{
    $data = pack('H*', $encrypted_id);
    $data = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, 'ecb');
    $data = base_convert($data, 36, 10);

    return $data;
}
