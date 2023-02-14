<?php

namespace App\Entity\Security;

use Eckinox\SecurityBundle\Entity\AbstractAppUser;
use Eckinox\SecurityBundle\Repository\AppUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppUserRepository::class)
 * @ORM\Table(name="eckinox_app_users")
 */
class AppUser extends AbstractAppUser
{

}
