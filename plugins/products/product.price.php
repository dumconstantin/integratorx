{% if not sonata_product_has_variations(product) %}
{{ sonata_product_price(product, currency, true)|number_format_currency(currency) }}
{% else %}
{% trans from 'SonataProductBundle' %}product_variation_min_price{% endtrans %}

{% set cheapest_variation = sonata_product_cheapest_variation(product) %}
{{ sonata_product_price(cheapest_variation, currency, true)|number_format_currency(currency) }}
{% endif %}