<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Eckinox\SecurityBundle\Entity\AbstractAppUser;
use Eckinox\SecurityBundle\Repository\AppUserRepository;

/**
 * @ORM\Entity(repositoryClass=AppUserRepository::class)
 *
 * @ORM\Table(name="eckinox_app_users")
 */
class AppUser extends AbstractAppUser
{
}
