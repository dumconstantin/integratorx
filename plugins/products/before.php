{% for product in pager %}

{% if not sonata_product_has_variations(product) or (sonata_product_has_variations(product) and sonata_product_has_enabled_variations(product)) %}
