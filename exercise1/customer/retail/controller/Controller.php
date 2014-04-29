<?php
namespace customer\retail\controller;
use customer\retail as retail;

class Controller {
  public function execute() {
    switch ('showItem') {
    case 'showItem' :
      require "customer/retail/utils/format.php";
      $item = new retail\model\Item();
      require "customer/retail/view/item.php";
      //autoload only gets classes, not functions or scripts
      break;
    }
  }
}
?>
