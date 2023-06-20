<?php

namespace Drupal\yashaswi_exercise;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\node\Entity\NodeType;

/**
 * Permissions for node.
 */
class NewPermission {
    use StringTranslationTrait;

    /**
     * Returns an array of permissions.
     *
     * @return array
     *      Permissions.
     *
     * @see \Drupal\user\PermissionHandlerInterface::getPermission
     */

     public function dynamicPerm() {
        $perms = [];
        foreach (NodeType::loadMultiple() as $type) {
          $type_id = $type->id();
          $type_params = ['%type' => $type->label()];
          $perms += [
            "clone $type_id perm" => [
              'title' => $this->t('%type: clone content', $type_params),
            ],
          ];
        }
        return $perms;
      }
     }
