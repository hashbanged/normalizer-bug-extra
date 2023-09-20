<?php

namespace App\Service\Serializer;

use App\Contract\DeprecatedInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DeprecatedUserProfileDataNormalizer implements NormalizerInterface
{
    private ObjectNormalizer $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($responseDto, string $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($responseDto, $format, $context);

        if (!$responseDto->isProfileIncluded()) {
            unset($data['profile']);
        }

        return $data;
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof DeprecatedInterface;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            DeprecatedInterface::class => true,
        ];
    }
}
