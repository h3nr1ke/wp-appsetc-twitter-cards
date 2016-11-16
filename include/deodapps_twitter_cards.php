<?php
/**
 * Generate the Twitter Cards Outputs
 * @author  Henrique Deodato <[h3nr1ke@gmail.com]>
 */

defined( 'ABSPATH' ) or die( 'Não não, perdão...' );

//************** Card Types **************
class TwitterCards{

  public function summary(){
    return '
    <!-- Deodapps Twitter Cards - Summary -->
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:site" content="%s" />
      <meta name="twitter:title" content="%s" />
      <meta name="twitter:description" content="%s" />
      <meta name="twitter:image" content="%s" />
      <meta name="twitter:image:alt" content="%s" />
    <!-- Deodapps Twitter Cards - Summary -->
    ';
  }

  public function summary_with_large_image(){
    return '
    <!-- Deodapps Twitter Cards - Summary with large image -->
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:site" content="%s" />
      <meta name="twitter:creator" content="%s">
      <meta name="twitter:title" content="%s" />
      <meta name="twitter:description" content="%s" />
      <meta name="twitter:image" content="%s" />
      <meta name="twitter:image:alt" content="%s" />
    <!-- Deodapps Twitter Cards - Summary with large image -->
    ';
  }
}
