<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Eckinox\SecurityBundle\Entity\AbstractUser;
use Eckinox\SecurityBundle\Repository\UserRepository;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 *
 * @ORM\Table(name="eckinox_users")
 */
class User extends AbstractUser
{
}
