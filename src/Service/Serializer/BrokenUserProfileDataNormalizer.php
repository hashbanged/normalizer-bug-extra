<?php

namespace App\Service\Serializer;

use App\Contract\BrokenInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BrokenUserProfileDataNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

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
        return $data instanceof BrokenInterface;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            BrokenInterface::class => true,
        ];
    }
}
