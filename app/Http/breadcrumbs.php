<?php

/**
* Главная
*/
Breadcrumbs::register('backend.home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('backend.home'));
});

/**
* Страницы
*/
// Главная > Страницы
Breadcrumbs::register('backend.pages', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.home');
    $breadcrumbs->push('Страницы', route('backend.pages'));
});
// Главная > Страницы > Создать страницу
Breadcrumbs::register('backend.pages.create', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.pages');
    $breadcrumbs->push('Создание страницы', route('backend.pages.create'));
});
// Главная > Страницы > Редактировать страницу
Breadcrumbs::register('backend.pages.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.pages');
    $breadcrumbs->push('Редактирование страницы', route('backend.pages.edit'));
});