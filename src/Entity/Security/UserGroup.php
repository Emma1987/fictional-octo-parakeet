<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Eckinox\SecurityBundle\Entity\AbstractUserGroup;
use Eckinox\SecurityBundle\Repository\UserGroupRepository;

/**
 * @ORM\Entity(repositoryClass=UserGroupRepository::class)
 *
 * @ORM\Table(name="eckinox_user_groups")
 */
class UserGroup extends AbstractUserGroup
{
}
