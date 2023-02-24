<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Eckinox\SecurityBundle\Entity\AbstractAppResetPasswordRequest;
use Eckinox\SecurityBundle\Repository\AppResetPasswordRequestRepository;

/**
 * @ORM\Entity(repositoryClass=AppResetPasswordRequestRepository::class)
 *
 * @ORM\Table(name="eckinox_app_reset_password_requests")
 */
class AppResetPasswordRequest extends AbstractAppResetPasswordRequest
{
}
