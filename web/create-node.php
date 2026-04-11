<?php

/**
 * @file
 * Create Types of Breast Cancer node.
 */

use Drupal\node\Entity\Node;

$node = Node::create([
  'type' => 'cancer_page',
  'title' => 'Types of Breast Cancer',
  'body' => [
    'value' => '<p class="mb-4">There are many types of breast cancer. The types differ based on several factors, such as which cells in the breast become cancer, whether the cancer has spread from where it first formed, and whether the cancer has certain features that affect treatment options.</p>
<p class="mb-4"><strong><a href="#" class="text-[#005ea2] underline">Invasive or infiltrating ductal carcinoma</a></strong> begins in the cells that line the <a href="#" class="text-[#005ea2] underline">milk ducts</a> and has spread beyond where it first formed. It is the most common breast cancer diagnosis. Learn more about <a href="#" class="text-[#005ea2] underline">Breast Cancer</a>.</p>
<p class="mb-4"><strong>Invasive lobular carcinoma</strong> begins in the cells that line the breast glands that make milk, called lobules, and has spread beyond where it first formed. It grows more slowly and is less common than invasive ductal carcinoma. Lobular carcinoma is more often found in both breasts than are other types of breast cancer.</p>
<p class="mb-4"><strong><a href="#" class="text-[#005ea2] underline">Inflammatory breast cancer</a></strong> is a rare form of breast cancer in which cancer cells block <a href="#" class="text-[#005ea2] underline">lymph vessels</a> in the skin of the breast. This type of breast cancer has a high risk of recurrence. It is called inflammatory because the affected breast often looks swollen and red, or inflamed.</p>
<p class="mb-4"><strong><a href="#" class="text-[#005ea2] underline">Triple-negative breast cancer</a></strong> is a form of breast cancer in which the cancer cells lack features that are common in breast cancer, including <a href="#" class="text-[#005ea2] underline">hormone receptors</a> and a protein called <a href="#" class="text-[#005ea2] underline">human epidermal growth factor receptor 2</a> (HER2). This form of breast cancer has a higher risk of recurrence than most other forms of breast cancer.</p>
<p class="mb-4"><strong><a href="#" class="text-[#005ea2] underline">Metastatic breast cancer</a></strong>, also called stage 4 breast cancer, is breast cancer that has spread from the breast to another part of the body. Metastatic spread occurs when breast cancer cells break away from the original tumor and travel through the <a href="#" class="text-[#005ea2] underline">lymph system</a> or blood to other sites in the body.</p>
<p class="mb-4"><strong><a href="#" class="text-[#005ea2] underline">Ductal carcinoma in situ (DCIS)</a></strong> forms in the cells that line the milk ducts but has not spread beyond where it first formed. DCIS is not breast cancer but increases the risk of developing breast cancer in the future. Learn more at <a href="#" class="text-[#005ea2] underline">Benign and Precancerous Breast Lumps and Conditions</a>.</p>
<p class="mb-4"><strong>Lobular carcinoma in situ (LCIS)</strong> forms in the cells that line the breast glands that make milk, called lobules, but has not spread beyond where it first formed. LCIS is not breast cancer but increases the risk of developing breast cancer in the future. Learn more at <a href="#" class="text-[#005ea2] underline">Benign and Precancerous Breast Lumps and Conditions</a>.</p>

<h2 class="mb-4 mt-8 font-[Merriweather] text-[28px] font-bold text-[#1b1b1b]">Molecular subtypes of breast cancer</h2>
<p class="mb-4">Molecular subtypes of breast cancer are defined by whether they have hormone receptors, HER2 protein, or other <a href="#" class="text-[#005ea2] underline">biomarkers</a>. Examples of molecular subtypes of breast cancer include triple-negative, luminal A, luminal B, and HER2-positive. Learn about how these subtypes are diagnosed and how they affect treatment at <a href="#" class="text-[#005ea2] underline">Tests for Breast Cancer Biomarkers</a> and <a href="#" class="text-[#005ea2] underline">Breast Cancer Treatment by Stage</a>.</p>

<hr class="my-6 border-t border-[#dfe1e2]" />

<p class="text-[14px] italic leading-[1.5] text-[#565c65]">If you would like to reproduce some or all of this content, see <a href="#" class="text-[#005ea2] underline">Reuse of NCI Information</a> for guidance about copyright and permissions. In the case of permitted digital reproduction, please credit the National Cancer Institute as the source and link to the original NCI product using the original product\'s title; e.g., "Types of Breast Cancer was originally published by the National Cancer Institute."</p>',
    'format' => 'full_html',
  ],
  'field_posted_date' => [
    'value' => '2025-12-02',
  ],
  'field_image_caption' => 'Talk to your doctor to find out what type of breast cancer you have and how it is used to plan the best treatment for you.',
  'status' => 1,
  'promote' => 0,
]);
$node->save();
print 'Created Types of Breast Cancer page: ' . $node->id() . "\n";
