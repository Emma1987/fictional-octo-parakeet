<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Eckinox\SecurityBundle\Entity\AbstractResetPasswordRequest;
use Eckinox\SecurityBundle\Repository\ResetPasswordRequestRepository;

/**
 * @ORM\Entity(repositoryClass=ResetPasswordRequestRepository::class)
 *
 * @ORM\Table(name="eckinox_reset_password_requests")
 */
class ResetPasswordRequest extends AbstractResetPasswordRequest
{
}
