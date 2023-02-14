<?php

namespace App\Entity\Security;

use Eckinox\SecurityBundle\Entity\AbstractAppUserGroup;
use Eckinox\SecurityBundle\Repository\AppUserGroupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppUserGroupRepository::class)
 * @ORM\Table(name="eckinox_app_user_groups")
 */
class AppUserGroup extends AbstractAppUserGroup
{

}
