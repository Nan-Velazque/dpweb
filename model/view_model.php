<?php
class viewModel
{
  protected static function get_view($views)
  {
    $white_list = [ "Home", "pruducts", "users", "new-user", "edit-user","categoria","products","edit-products","edit-categories",
    ];
    if (in_array($views, $white_list)) {
      if (is_file("./view/" . $views . ".php")) {
        $content = "./view/" . $views . ".php";
      } else {
        $content = "404";
      }
    } elseif ($views == "login") {
      $content = "login";
    } else {
      $content = "404";
    }
    return $content;
  }
}
