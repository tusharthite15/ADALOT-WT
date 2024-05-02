<?php

if (extension_loaded('openssl')) {
    echo 'The OpenSSL extension is enabled.';
} else {
    echo 'The OpenSSL extension is not enabled.';
}

?>