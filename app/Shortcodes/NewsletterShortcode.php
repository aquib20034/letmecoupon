<?php

namespace App\Shortcodes;

class NewsletterShortcode {

  public function register($shortcode, $content, $compiler, $name, $viewData)
  {
    $data = [];
    $style = ($shortcode->style)?$shortcode->style:'style2';
    return view('components.web.newsletter.'.$style,$data);
  }
}