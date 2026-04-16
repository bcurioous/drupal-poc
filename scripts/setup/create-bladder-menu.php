<?php
// Create menu items for Bladder Cancer page
use Drupal\menu_link_content\Entity\MenuLinkContent;

// Create sidebar menu: Bladder Cancer (top-level)
$bladders_menu = MenuLinkContent::create([
  'title' => 'Bladder Cancer',
  'link' => ['uri' => 'internal:/types/bladder'],
  'menu_name' => 'main',
  'weight' => 5,
  'expanded' => TRUE,
]);
$bladders_menu->save();

// Create child menu items for sidebar under Bladder Cancer
$child_items = [
  'Causes & Risk Factors' => '/types/bladder/causes-risk-factors',
  'Symptoms' => '/types/bladder/symptoms',
  'Screening' => '/types/bladder/screening',
  'Diagnosis' => '/types/bladder/diagnosis',
  'Prognosis & Survival Rates' => '/types/bladder/survival',
  'Stages' => '/types/bladder/stages',
  'Treatment' => '/types/bladder/treatment',
  'Childhood Bladder Cancer' => '/types/bladder/childhood',
  'Coping & Treatment Issues' => '/types/bladder/coping',
  'Health Professional' => '/types/bladder/hp',
  'Research Advances' => '/types/bladder/research',
];

$weight = 0;
foreach ($child_items as $title => $link) {
  $menu_item = MenuLinkContent::create([
    'title' => $title,
    'link' => ['uri' => 'internal:' . $link],
    'menu_name' => 'main',
    'parent' => 'menu_link_content:' . $bladders_menu->uuid(),
    'weight' => $weight,
  ]);
  $menu_item->save();
  $weight++;
}

print 'Created Bladder Cancer menu item with ' . count($child_items) . ' children in main menu' . PHP_EOL;