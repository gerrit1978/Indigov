<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function indigov_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  indigov_preprocess_html($variables, $hook);
  indigov_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function indigov_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function indigov_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */

function indigov_preprocess_node(&$variables, $hook) {
  if (isset($variables['submitted']) && strlen($variables['submitted'])) {
    $author = user_load($variables['node']->uid);
    $author_name = $author->name;
  
    $submit = t('Posted by !username on !postdate', array(
      '!username' => $author_name,
      '!postdate' => format_date($variables['node']->created, 'short'),
    ));
  
    $variables['submitted'] = $submit;
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function indigov_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function indigov_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function indigov_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */

/**
 * Implements theme_menu_link
 *
 * We do this to allow HTML in menu links
 *
 */
function indigov_menu_link(array $variables) {
  $element = $variables['element'];
  
  $element['#localized_options']['html'] = TRUE;
  
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Preprocess Panels Pane -> used for the background of the title 
 */
function indigov_preprocess_panels_pane(&$variables) {
  $variables['title'] = "<span>" . $variables['title'] . "</span>";
  $variables['title_suffix'] = "<div class='hoekske'></div>";
}

/**
 * Process Blocks -> used for the background of the title 
 * We need to use process instead of preprocess since Zen
 * does some processing of the block. The variable title
 * is not available in preprocess yet
 */
function indigov_process_block(&$variables) {
  if (isset($variables['title']) && strlen($variables['title'])) {
	  $variables['title'] = "<span>" . $variables['title'] . "</span>";
	  $variables['title_suffix'] = "<div class='block-hoekske'></div>";
  }
}

/**
 * Theme field__FIELD_NAME
 */
function indigov_field__field_page_blocks($variables) {
  $output = '';

  // first, define the number of rows
  $number_of_rows = ceil(count($variables['items']) / 4);

  for ($i = 0; $i < $number_of_rows; $i++) {
    $output .= "<div class='row clearfix'>";
    for ($j = 0; $j < 4; $j++) {
      $body = "";
      $delta = ($i * 4) + $j;
      $field_collection_item_id = "";
      $item = isset($variables['items'][$delta]['entity']['field_collection_item']) ? $variables['items'][$delta]['entity']['field_collection_item'] : array();
      foreach ($item as $id => $dummy) {
        $field_collection_item_id = $id;
      }
      if ($field_collection_item_id) {
        $item_wrapper = entity_metadata_wrapper('field_collection_item', $field_collection_item_id);
        $body = $item_wrapper->field_page_block_body->value();              
        $item_output = array(
          'title' => $item_wrapper->field_page_block_title->value(),
	        'subtitle' => $item_wrapper->field_page_block_subtitle->value(),
	        'body' => $body['value'],
	      );
        $output .= "<div class='item'>" 
          . "<div class='title'>" . $item_output['title'] . "</div>";
        if ($item_output['subtitle']) {
          $output .= "<div class='subtitle'>" . $item_output['subtitle'] . "</div>";
        }
        $output .= "<div class='body'>" . $item_output['body'] . "</div>"
          . "</div>";
      }
    }
    $output .= "</div>";
  }

  return $output;

}