<?php

namespace App\Traits;

use App\WebModel\Site;
use Illuminate\Support\Facades\Cache;

trait MetaWriterTrait
{
  /**
   * @param string $TEMPLATE
   * @param string[] $REPLACEMENTS
   * 
   * @return string
   */
  private function replaceTags($TEMPLATE, $REPLACEMENTS)
  {
    $replacedTemplate = $TEMPLATE;

    foreach ($REPLACEMENTS as $tag => $content) :

      $replacedTemplate = str_replace("[$tag]", $content, $replacedTemplate);

    endforeach;

    return $replacedTemplate;
  }

  /**
   * @param int $SITE_ID
   * 
   * @return array
   */
  public function getMetaTemplates($SITE_ID)
  {
    return Cache::remember("SiteWide__MetaTemplates__{$SITE_ID}", 3600, function () use ($SITE_ID) {
      return Site::select(
        'country_code',
        'primary_keyword',
        'secondary_keyword',
        'store_meta_title_template',
        'store_meta_description_template',
        'category_meta_title_template',
        'category_page_title_template',
        'category_meta_description_template'
      )
        ->where('publish', 1)
        ->where('id', $SITE_ID)
        ->first()
        ->toArray();
    });
  }

  /**
   * @param string $TEMPLATE
   * @param string $ENTITY_NAME
   * @param string $REGION
   * @param string $PRIMARY_KEYWORD
   * @param string $SECONDARY_KEYWORD
   * 
   * @return string
   */
  public function writeMetaFromTemplate($TEMPLATE, $ENTITY_NAME, $REGION, $PRIMARY_KEYWORD, $SECONDARY_KEYWORD)
  {
    if (!$TEMPLATE) return '';

    $tagReplacements = array(
      "LOWERCASE_TITLE"   => strtolower($ENTITY_NAME),
      "TITLECASE_TITLE"   => ucwords(strtolower($ENTITY_NAME)),
      "UPPERCASE_REGION"  => strtoupper($REGION),
      "PRIMARY_KEYWORD"   => $PRIMARY_KEYWORD,
      "SECONDARY_KEYWORD" => $SECONDARY_KEYWORD,
      "DATE_F_Y"          => date("F Y"),
    );

    return $this->replaceTags($TEMPLATE, $tagReplacements);
  }
}
