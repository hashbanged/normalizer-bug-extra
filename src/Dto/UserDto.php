<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;

class UserDto
{
    #[Ignore]
    protected bool $includeProfile = false;

    public function __construct(
        #[SerializedName('firstName')] public readonly string $firstName,
        #[SerializedName('lastName')] public readonly string $lastName,
        #[SerializedName('profile')] public readonly ?array $profile
    ) {
    }

    #[Ignore]
    public function isProfileIncluded(): bool
    {
        return $this->includeProfile;
    }

    public function excludeProfile(): void
    {
        $this->includeProfile = false;
    }

    public function includeProfile(): void
    {
        $this->includeProfile = true;
    }
}
