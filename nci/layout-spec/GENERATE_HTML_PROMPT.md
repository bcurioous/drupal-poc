# Generate HTML from Layout JSON

## Task: Reconstruct index.html from layout.json

You are given a JSON layout specification at `./layout.json` that describes a complete NCI Cancer.gov webpage structure.

## Your Job

Read the JSON file and **reconstruct the original index.html** by iterating through the layout array and rendering each section.

## Rules for Reconstruction

### 1. Follow the `tag` and `attrs` exactly
- Use the exact HTML tag specified
- Apply ALL classes from `attrs.class` verbatim
- Apply all other attributes (src, href, alt, onclick, type, etc.) verbatim

### 2. Handle `text` vs `children`
- If `text` is present: render it as the element's text content
- If `children` is present: render each child recursively
- If `child` (singular) is present: render that single child

### 3. Handle `repeatable: true` items
When you see `"repeatable": true`:
1. Iterate through the `items` array
2. For each item, apply data to the `itemTemplate`
3. Use conditional expressions like `{{#if bold}}` to conditionally add classes
4. Handle icon suffixes when `{{#if hasIcon}}` is true

### 4. Handle `container` objects
When a section has a `container` property, that represents a wrapper div. Render it with its tag and attrs, then render its children/child inside.

### 5. Rich Text Handling
For content with `"type": "rich-text"`, render:
- `{ "bold": true, "text": "..." }` → `<strong>...</strong>`
- `{ "bold": true, "links": [...] }` → `<strong><a href="...">...</a></strong>`
- `{ "links": [...] }` → `<a href="...">...</a>`
- Plain `{ "text": "..." }` → rendered as-is

### 6. Footer Grid Columns
The footer has `columns[]` array with 4 items. Render each as a `<div>` with:
- `<h3>` with the `title`
- `<ul>` with each `item` as `<li>`

### 7. Preserve Order
Render sections in the order they appear in the `layout` array.

## Output Requirements

1. Write the complete HTML to `./index-generated.html`
2. The HTML must be identical to the original index.html when compared structurally
3. Include the full `<!doctype html>` declaration and proper closing tags
4. Use exact Tailwind classes as specified in the JSON
5. Preserve whitespace formatting that matches the original

## Verification

After generating, compare your output to ensure:
- All 19 sidebar items are rendered
- All 6 nav items have their icons
- The breadcrumb has correct separator pattern
- Footer has all 4 columns with correct items
- The featured image widget is complete with caption and credit
