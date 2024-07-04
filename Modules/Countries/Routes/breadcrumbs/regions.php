<?php

Breadcrumbs::for('dashboard.countries.regions.edit', function ($breadcrumb, $country, $city, $region) {
    $breadcrumb->parent('dashboard.countries.show', $country);
    $breadcrumb->push(
        trans('countries::regions.actions.edit'),
        route('dashboard.countries.cities.regions.edit', [$country, $city, $region])
    );
});
