<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('LB', route('root'));
});

Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('home');

    foreach ($category->ancestors as $ancestor) {
        $trail->push($ancestor->name, route('categories.show', $ancestor->id));
    }

    $trail->push($category->name, route('categories.show', $category->id));
});

Breadcrumbs::for('topics.show', function ($trail, $topic) {
    $trail->parent('category', $topic->category);
    $trail->push($topic->title, route('topics.show', $topic->id));
});