<?php

namespace Drupal\yashaswi_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\yashaswi_exercise\CustomService;
use Symfony\Component\HttpFoundation\Response;


class CustomController extends ControllerBase {

    public function exercise() { #defined function name exercise
      $data = \Drupal::service('custom_service')->getName(); // calling the service
        return [
            '#theme'=>'controller_template', #using the templte we created here
            '#markup'=>$data, #returning the data used in service
            '#hexcode'=>'#0000FF', #providing value so that the username displays in red color
        ];
    }
}