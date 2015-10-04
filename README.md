# Page Render Package for Laravel

 * Simple key-value storage
 * Support multi-level array (dot delimited keys) structure.
 * Localization supported.

## Installation

1. install package

	```php
		composer require unisharp/laravel-pagerender
	```

1. use the trait in your model

	```php
		use \Unisharp\Pagerender\Pagerender;
	```

1. make sure your table has these columns : `parent_id`, `alias`, `custom_view`

## Usage

```php
	$page = new Page();

	$page->render();
	// Generates the default view(or custom view if the column is not empty).

	$page->subs;
	// Get children pages.

	$page->hasSubs();
	// Check if children pages exist.

	$page->parent;
	// Get parent page.

	$page->hasParent();
	// Check if parent page exists.

	$page->roots();
	// Get all pages at top level.

	$page->isRoot();
	// Check if this page is at top level.

	$page->getByAlias('aboutus');
	// Get the about us page.

    $page->hasByAlias('aboutus');
    // Check if the about us page exists.

    $page->allWithAlias();
    // Get pages that have alias.

    $page->getLevel();
    // Get level count(top level as 0).

    $page->ancestors();
    // Get all parent pages of the current page.
```

## Todo

```php
	$page->tree();
	// Get all pages with parent-child structure.
```
