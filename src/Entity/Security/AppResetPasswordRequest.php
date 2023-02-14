<?php

namespace App\Entity\Security;

use Eckinox\SecurityBundle\Entity\AbstractAppResetPasswordRequest;
use Eckinox\SecurityBundle\Repository\AppResetPasswordRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppResetPasswordRequestRepository::class)
 * @ORM\Table(name="eckinox_app_reset_password_requests")
 */
class AppResetPasswordRequest extends AbstractAppResetPasswordRequest
{

}