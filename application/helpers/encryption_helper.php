
<?php 

/**
 * aes256encrypt
 *
 * @param string $string string to be encrypted
 * @return [string] [encrypted string]
 */
function aes256encrypt($string)
{
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    return $output;
}
/**
 * aes256decrypt
 *
 * @param string $string string to be decrypted
 * @return [string] [decrypted string]
 */
function aes256decrypt($string)
{
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

?>