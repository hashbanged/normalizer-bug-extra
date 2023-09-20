<?php

namespace App\Service\Serializer;

use App\Dto\UserDto;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class DtoSerializer
{
    public const JSON_ENCODE_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES;

    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function serialize(UserDto $dto): string
    {
        $serialized = $this->serializer->serialize($dto, JsonEncoder::FORMAT, [
            JsonEncode::OPTIONS => DtoSerializer::JSON_ENCODE_OPTIONS,
            AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
        ]);

        if (!$serialized) {
            $message = 'Unable to serialize the response data.';

            throw new \Exception($message);
        }

        return $serialized;
    }
}
