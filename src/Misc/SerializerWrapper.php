<?php
namespace Varavin\TestWidget\Misc;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerWrapper
{
    public static function jsonToObject(string $json, string $className)
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        return $serializer->deserialize($json, $className, 'json');
    }

    public static function objectToJson($object): string
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        return $serializer->serialize($object, 'json');
    }
}