<?php

namespace Drupal\yashaswi_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Returns Title.
 */
class NewNodeController extends ControllerBase {

  /**
   * The _title_callback for the node.clone route.
   *
   * @param \Drupal\node\Entity\Node $node
   *   The current node.
   *
   * @return string
   *   The page title.
   */
  public function getNode(Node $node) {
    if (!empty($node)) {
        $title = $node->getTitle();
        return [
            '#markup'=>$title,
        ];
    }
    else {
            throw new NotFoundHttpException();
    }
  }
  public function getPageTitle(Node $node) {
    $prepend_text = "Node of";
    return $prepend_text.$node->getTitle();
  }

  public function accessNode(AccountInterface $account, $node) {
    $node = Node::load($node);
    $type = $node -> getType();
    $type_id=$node->bundle();
    if ($account->hasPermission("clone $type_id perm")) {
        $result = AccessResult::allowed();
    }
    else {
        $result = AccessResult::forbidden();
    }

        $result->addCacheableDependency($node);

    return $result;
  }
    }

