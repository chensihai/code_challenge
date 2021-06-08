<?php

namespace Drupal\code_challenge\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Class AjaxCode.
 */
class AjaxCode implements CommandInterface {

  /**
   * Render custom ajax command.
   *
   * @return ajax
   *   Command function.
   */
  public function render() {
    return [
      'command' => 'hello',
      'message' => 'My Awesome Message',
    ];
  }

}
