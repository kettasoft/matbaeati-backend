<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('dashboard.categories.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('categories::categories.plural'), route('dashboard.categories.index'));
});

Breadcrumbs::for('dashboard.categories.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.categories.index');
    $breadcrumb->push(trans('categories::categories.actions.create'), route('dashboard.categories.create'));
});

Breadcrumbs::for('dashboard.categories.show', function ($breadcrumb, $article) {
    $breadcrumb->parent('dashboard.categories.index');
    $breadcrumb->push(Illuminate\Support\Str::limit($article->name, $limit = 50, $end = '...'), route('dashboard.categories.show', $article));
});

Breadcrumbs::for('dashboard.categories.edit', function ($breadcrumb, $article) {
    $breadcrumb->parent('dashboard.categories.show', $article);
    $breadcrumb->push(trans('categories::categories.actions.edit'), route('dashboard.categories.edit', $article));
});
