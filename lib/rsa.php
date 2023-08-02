<?php
// ���Ī �˰����� RSA�� ����Ͽ� ���ڿ��� ��ȣȭ�ϴ� ��.
// ����Ű ��й�ȣ�� ��ȣȭ�� ���� �ʿ���� ��ȣȭ�� ���� �Է��ϸ� �ǹǷ�
// ������ ������ �ʿ� ���� �׶��׶� �����ڰ� �Է��ϵ��� �ص� �ȴ�.
// PHP 5.2 �̻�, openssl ����� �ʿ��ϴ�.

// RSA ����Ű, ����Ű ������ �����Ѵ�.
// Ű �������� �ð��� ���� �ɸ��Ƿ�, �� ���� �����Ͽ� ������ �ΰ� ����ϸ� �ȴ�.
// ��, ��й�ȣ�� ����Ű�� ����� ������ �ʿ��ϴ�.

$openssl_pkcs1_padding_custom = 11;

function rsa_generate_keys($password, $bits = 4096, $digest_algorithm = 'sha512')
{
    $res = openssl_pkey_new(array(
        'digest_alg' => $digest_algorithm,
        'private_key_bits' => $bits,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ));
    
    openssl_pkey_export($res, $private_key, $password);
    
    $public_key = openssl_pkey_get_details($res);
    $public_key = $public_key['key'];
    
	openssl_pkey_free(@res);
	
    return array(
        'private_key' => $private_key,
        'public_key' => $public_key,
    );
}

function rsa_detail($key, $type)
{
	$res = false;
	if($type == "private")
	{
		echo "//baa//<br/>";
		$res = @openssl_pkey_get_private($key);
	}
	else
	{
		$res = @openssl_pkey_get_public($key);
	}
	
	if($res === false) return false;
	echo "//bab//<br/>";
	
	$detail = false;
	$detail = @openssl_pkey_get_details($res);
	if($detail === false) return false;
	echo "//bac//". $detail["bits"] ."<br/>";
	
	return $detail;
}

// RSA ����Ű�� ����Ͽ� ���ڿ��� ��ȣȭ�Ѵ�.
// ��ȣȭ�� ���� ��й�ȣ�� �ʿ����� �ʴ�.
// ������ �߻��� ��� false�� ��ȯ�Ѵ�.
function rsa_encrypt($plaintext, $public_key)
{
    // �뷮 ������ ���� ����� ���� ���� �����Ѵ�.
    $plaintext = gzcompress($plaintext);
    
    // ����Ű�� ����Ͽ� ��ȣȭ�Ѵ�.
    $pubkey_decoded = @openssl_pkey_get_public($public_key);
    if ($pubkey_decoded === false) return false;
    
    $ciphertext = false;
    $status = @openssl_public_encrypt($plaintext, $ciphertext, $pubkey_decoded);
    if (!$status || $ciphertext === false) return false;
    
    // ��ȣ���� base64�� ���ڵ��Ͽ� ��ȯ�Ѵ�.
    return base64_encode($ciphertext);
}

function rsa_encrypt2($plaintext, $public_key)
{
	//Auto Split Length 2048bit = 256byte - padding 11byte = 245byte
    // �뷮 ������ ���� ����� ���� ���� �����Ѵ�.
    $plaintext = gzcompress($plaintext);
	
    // ����Ű�� ����Ͽ� ��ȣȭ�Ѵ�.
    $pubkey_decoded = @openssl_pkey_get_public($public_key);
    if ($pubkey_decoded === false) return false;
    
	$keydetail = @openssl_pkey_get_details($pubkey_decoded);
	if ($keydetail === false) return false;
	
	global $openssl_pkcs1_padding_custom;
    $bits = $keydetail["bits"] / 8 - $openssl_pkcs1_padding_custom;
	
	$maximum = intval(strlen($plaintext) / $bits + 1);
	
	$result = false;
	for($count = 0 ; $count < $maximum ; $count++)
	{
		$partialdata = substr($plaintext, $count * $bits, $bits);
		if($count == $maximum - 1)
			$partialdata = substr($plaintext, $count * $bits);
		
		$ciphertext = false;
		$status = @openssl_public_encrypt($partialdata, $ciphertext, $pubkey_decoded);
		
		if (!$status || $ciphertext === false) return false;
		$result .= $ciphertext;
    }
	
    // ��ȣ���� base64�� ���ڵ��Ͽ� ��ȯ�Ѵ�.
    return base64_encode($result);
}

// RSA ����Ű�� ����Ͽ� ���ڿ��� ��ȣȭ�Ѵ�.
// ��ȣȭ�� ���� ��й�ȣ�� �ʿ��ϴ�.
// ������ �߻��� ��� false�� ��ȯ�Ѵ�.
function rsa_decrypt($ciphertext, $private_key, $password)
{
    // ��ȣ���� base64�� ���ڵ��Ѵ�.
    $ciphertext = @base64_decode($ciphertext, true);
    if ($ciphertext === false) return false;
    
    // ����Ű�� ����Ͽ� ��ȣȭ�Ѵ�.
    $privkey_decoded = @openssl_pkey_get_private($private_key, $password);
    if ($privkey_decoded === false) return false;
    
    $plaintext = false;
    $status = @openssl_private_decrypt($ciphertext, $plaintext, $privkey_decoded);
    @openssl_pkey_free($privkey_decoded);
    if (!$status || $plaintext === false) return false;
    
    // ������ �����Ͽ� ���� ��´�.
    $plaintext = @gzuncompress($plaintext);
    if ($plaintext === false) return false;
    
    // �̻��� ���� ��� ���� ��ȯ�Ѵ�.
    return $plaintext;
}

function rsa_decrypt2($ciphertext, $private_key, $password)
{
    // ��ȣ���� base64�� ���ڵ��Ѵ�.
    $ciphertext = @base64_decode($ciphertext, true);
    if ($ciphertext === false) return false;
	
    // ����Ű�� ����Ͽ� ��ȣȭ�Ѵ�.
    $privkey_decoded = @openssl_pkey_get_private($private_key, $password);
    if ($privkey_decoded === false) return false;
	
	$keydetail = @openssl_pkey_get_details($privkey_decoded);
    if ($keydetail === false) return false;
    $bits = $keydetail["bits"] / 8;
	
	$maximum = intval(strlen($ciphertext) / $bits);
	
	$result = false;
	for($count = 0 ; $count < $maximum ; $count++)
	{
		$partialdata = substr($ciphertext, $count * $bits, $bits);
		if($count == $maximum - 1)
			$partialdata = substr($ciphertext, $count * $bits);
		
		$plaintext = false;
		$status = @openssl_private_decrypt($partialdata, $plaintext, $privkey_decoded);
		
		if (!$status || $plaintext === false) return false;
		$result .= $plaintext;
    }
	
	@openssl_pkey_free($privkey_decoded);
	
    // ������ �����Ͽ� ���� ��´�.
    $result = @gzuncompress($result);
    if ($result === false) return false;
    
    // �̻��� ���� ��� ���� ��ȯ�Ѵ�.
    return $result;
}

?>