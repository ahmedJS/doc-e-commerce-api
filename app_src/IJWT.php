<?php
namespace eCommerceApi;
Interface IJWT{
    function encode(array $payload,
    $key,
    string $alg,
);
    function decode();
}