<?php
// Create the What Is Bladder Cancer page
use Drupal\node\Entity\Node;
use Drupal\pathauto\PathautoState;

$node = Node::create([
  'type' => 'cancer_page',
  'title' => 'What Is Bladder Cancer?',
  'body' => [
    'value' => '<p>Bladder cancer occurs when cells in the bladder start to grow without control. The bladder is a hollow, balloon-shaped organ in the lower part of the abdomen that stores urine.</p>

<p>The bladder has a muscular wall that allows it to get larger to store urine made by the kidneys and to shrink to squeeze urine out of the body. There are two kidneys, one on each side of the backbone, above the waist. The bladder and kidneys work together to remove toxins and wastes from your body through urine:</p>

<ul>
<li>Tiny tubules in the kidneys filter and clean the blood.</li>
<li>These tubules take out waste products and make urine.</li>
<li>The urine passes from each kidney through a long tube called a ureter into the bladder.</li>
<li>The bladder holds the urine until it passes through a tube called the urethra and leaves the body.</li>
</ul>

<h2>Types of bladder cancer</h2>

<p><strong>Urothelial carcinoma</strong> (also called transitional cell carcinoma) is cancer that begins in the urothelial cells, which line the urethra, bladder, ureters, renal pelvis, and some other organs. Almost all bladder cancers are urothelial carcinomas.</p>

<p>Urothelial cells are also called transitional cells because they change shape. These cells are able to stretch when the bladder is full of urine and shrink when it is emptied.</p>

<p>Other types of bladder cancer are rare:</p>

<ul>
<li><strong>Squamous cell carcinoma</strong> is cancer that begins in squamous cells (thin, flat cells lining the inside of the bladder). This type of cancer may form after long-term irritation or infection with a tropical parasite called schistosomiasis, which is common in Africa and the Middle East but rare in the United States. When chronic irritation occurs, transitional cells that line the bladder can gradually change to squamous cells.</li>
<li><strong>Adenocarcinoma</strong> is cancer that begins in glandular cells that are found in the lining of the bladder. Glandular cells in the bladder make mucus and other substances.</li>
<li><strong>Small cell carcinoma of the bladder</strong> is cancer that begins in neuroendocrine cells (nerve-like cells that release hormones into the blood in response to a signal from the nervous system).</li>
</ul>

<p>There are other ways to describe bladder cancer:</p>

<ul>
<li><strong>Non-muscle-invasive bladder cancer</strong> is cancer that has not reached the muscle wall of the bladder. Most bladder cancers are non-muscle-invasive.</li>
<li><strong>Muscle-invasive bladder cancer</strong> is cancer that has spread through the lining of the bladder and into the muscle wall of the bladder or beyond it.</li>
</ul>

<h2>Learn more about bladder cancer</h2>

<p><strong>Symptoms</strong><br>
Many bladder cancer symptoms are also seen with other less serious conditions. These are the warning signs you shouldn\'t ignore.</p>

<p><strong>Causes and Risk Factors</strong><br>
Using tobacco, especially smoking cigarettes, is a major risk factor for bladder cancer. Learn about tobacco use and other risk factors for bladder cancer and what you can do to lower your risk.</p>

<p><strong>Screening</strong><br>
Learn about bladder cancer screening tests for people at high risk.</p>

<p><strong>Diagnosis</strong><br>
Learn about the tests that are used to diagnose and stage bladder cancer.</p>

<p><strong>Prognosis and Survival Rates</strong><br>
Learn about bladder cancer survival rates and why this statistic doesn\'t predict exactly what will happen to you.</p>

<p><strong>Stages</strong><br>
Stage refers to the extent of your cancer, such as how large the tumor is and if it has spread. Learn about bladder cancer stages, an important factor in deciding your treatment plan.</p>

<p><strong>Treatment</strong><br>
Learn about the different ways bladder cancer can be treated.</p>

<p><strong>Coping and Support</strong><br>
Coping with bladder cancer and the side effects of treatment can feel overwhelming. Learn about resources to help you cope and gain a sense of control.</p>

<p><strong>Childhood Bladder Cancer</strong><br>
Childhood bladder cancer is a very rare type of cancer that forms in the tissues of the bladder. Learn about the symptoms of bladder cancer in children, and how it is diagnosed and treated.</p>

<hr />
<p class="text-sm italic text-gray-600">If you would like to reproduce some or all of this content, see <a href="/policies/copyright-reuse">Reuse of NCI Information</a> for guidance about copyright and permissions. In the case of permitted digital reproduction, please credit the National Cancer Institute as the source and link to the original NCI product using the original product\'s title; e.g., "What Is Bladder Cancer? was originally published by the National Cancer Institute."</p>',
    'format' => 'full_html',
  ],
  'field_posted_date' => [
    'value' => '2023-02-16',
  ],
  'field_image_caption' => 'Anatomy of the male urinary system (left panel) and female urinary system (right panel) showing the kidneys, ureters, bladder, and urethra.',
  'status' => 1,
  'promote' => 0,
]);
$node->save();

// Set the path alias to /types/bladder
$path_alias_storage = \Drupal::entityTypeManager()->getStorage('path_alias');
$path_alias = $path_alias_storage->create([
  'path' => '/node/' . $node->id(),
  'alias' => '/types/bladder',
  'langcode' => 'en',
]);
$path_alias->save();

print 'Created What Is Bladder Cancer page: ' . $node->id() . ' with alias /types/bladder' . PHP_EOL;