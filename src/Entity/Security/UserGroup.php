<?php

namespace App\Entity\Security;

use Eckinox\SecurityBundle\Entity\AbstractUserGroup;
use Eckinox\SecurityBundle\Repository\UserGroupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserGroupRepository::class)
 * @ORM\Table(name="eckinox_user_groups")
 */
class UserGroup extends AbstractUserGroup
{

}
