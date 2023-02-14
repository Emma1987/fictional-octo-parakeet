<?php

namespace App\Entity\Security;

use Eckinox\SecurityBundle\Entity\AbstractUser;
use Eckinox\SecurityBundle\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="eckinox_users")
 */
class User extends AbstractUser
{

}
