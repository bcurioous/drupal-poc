<?php
// Update menu items to show Bladder Cancer sidebar and fix main navigation
use Drupal\menu_link_content\Entity\MenuLinkContent;
use Drupal\node\Entity\Node;

// First, let's find and update the existing menu items
$menu_storage = \Drupal::entityTypeManager()->getStorage('menu_link_content');

// Load all main menu items
$menu_items = \Drupal::entityTypeManager()->getStorage('menu_link_content')->loadByProperties(['menu_name' => 'main']);

foreach ($menu_items as $item) {
  $title = $item->getTitle();
  $link = $item->link->getValue();
  $uri = isset($link['uri']) ? $link['uri'] : '';
  
  // Check if this is a Breast Cancer related item
  if (strpos($title, 'Breast') !== false || strpos($uri, 'breast') !== false) {
    print "Found Breast Cancer item: $title ($uri)" . PHP_EOL;
  }
}

// Find the Types of Breast Cancer node
$nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'cancer_page']);
foreach ($nodes as $node) {
  if (strpos($node->getTitle(), 'Breast') !== false) {
    print "Found Breast Cancer node: " . $node->id() . PHP_EOL;
  }
}

// Create Bladder Cancer specific menu items that override breast cancer
// The bladder cancer menu items should be tied to the /types/bladder path

print "Creating Bladder Cancer sidebar menu items..." . PHP_EOL;

// We need to create proper menu items that appear when on bladder cancer pages
// These will be shown in the sidebar block