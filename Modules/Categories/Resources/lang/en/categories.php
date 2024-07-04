<?php

return [
    'singular' => 'Category',
    'plural' => 'Categories',
    'empty' => 'There are no categorys yet.',
    'count' => 'Categories count',
    'search' => 'Search',
    'select' => 'Select Category',
    'perPage' => 'Categories Per Page',
    'filter' => 'Search for category',
    'total' => 'Total Categories',
    'actions' => [
        'list' => 'List all',
        'create' => 'Create Category',
        'show' => 'Show Category',
        'edit' => 'Edit Category',
        'delete' => 'Delete Category',
        'options' => 'Options',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The category has been created successfully.',
        'updated' => 'The category has been updated successfully.',
        'deleted' => 'The category has been deleted successfully.',
        'cant_delete' => 'Sorry, the category that has already been booked cannot be deleted',
        'images_note' => 'Supported types: jpeg, png,jpg | Max File Size:10MB',
    ],
    'attributes' => [
        'name' => 'Category Name',
        '%name%' => 'Category Name',
        'description' => 'Category Description',
        '%description%' => 'Category Description',
        'empty' => 'No Data',
        'image' => 'Category Image',
        'active' => 'Activate the category',
        'parent' => 'Parent category',
        'status' => 'Category status',
        'subcategories' => 'Subcategories',
    ],
    'fields' => [
        'name' => 'Category Name*',
        '%name%' => 'Category Name*',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the category?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];
