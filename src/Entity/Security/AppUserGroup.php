<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Eckinox\SecurityBundle\Entity\AbstractAppUserGroup;
use Eckinox\SecurityBundle\Repository\AppUserGroupRepository;

/**
 * @ORM\Entity(repositoryClass=AppUserGroupRepository::class)
 *
 * @ORM\Table(name="eckinox_app_user_groups")
 */
class AppUserGroup extends AbstractAppUserGroup
{
}
