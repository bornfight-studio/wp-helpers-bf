# wp-helpers

# Breadcrumbs helper

Automaticly build breadcrumbs.

```php
$breadcrumbs_helper = new BreadcrumbsHelper( __( 'Home', 'bwp-web-2023' ) );
$items = $breadcrumbs_helper->get_crumbs();
```

```html
<ul class="c-breadcrumbs__list">
    <?php foreach ( $items as $key => $item ) { ?>
        <li class="c-breadcrumbs__list-item u-b2">
            <?php if ( ! empty( $item['url'] ) ) { ?>
                <a href="<?php echo esc_url( $item['url'] ); ?>" class="c-breadcrumbs__list-link">
                    <?php echo esc_html( $item['title'] ); ?>
                </a>
            <?php } else { ?>
                <span class="c-breadcrumbs__list-link">
                    <?php echo esc_html( $item['title'] ); ?>
                </span>
            <?php } ?>
            <?php if ( ! $item['last'] ) { ?>
                <span class="c-breadcrumbs__list-separator">
                    <?php echo get_icon('chevron-right-menu'); ?>
                </span>
            <?php } ?>
        </li>
    <?php } ?>
</ul>
```

Build breadcrumbs manualy.

```php
$breadcumb_helper = new BreadcrumbsHelper();
$breadcumb_helper->reset_crumbs();
$breadcumb_helper->add_crumb( get_the_title( $page_blog ),  get_the_permalink( $page_blog ), true);
$breadcumb_helper->add_crumb( get_the_title(),  get_the_permalink(), true);
$items = $breadcrumbs_helper->get_crumbs();
```