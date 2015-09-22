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


/**
* Новости
*/
// Главная > Новости
Breadcrumbs::register('backend.news', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.home');
    $breadcrumbs->push('Новости', route('backend.news'));
});
// Главная > Новости > Создать страницу
Breadcrumbs::register('backend.news.create', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.news');
    $breadcrumbs->push('Создание новости', route('backend.news.create'));
});
// Главная > Новости > Редактировать страницу
Breadcrumbs::register('backend.news.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.news');
    $breadcrumbs->push('Редактирование новости', route('backend.news.edit'));
});

/**
* Статьи
*/
// Главная > Статьи
Breadcrumbs::register('backend.articles', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.home');
    $breadcrumbs->push('Статьи', route('backend.articles'));
});
// Главная > Статьи > Создать страницу
Breadcrumbs::register('backend.articles.create', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.articles');
    $breadcrumbs->push('Создание новости', route('backend.articles.create'));
});
// Главная > Статьи > Редактировать страницу
Breadcrumbs::register('backend.articles.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.articles');
    $breadcrumbs->push('Редактирование статьи', route('backend.articles.edit'));
});


/**
* Контакты
*/
// Главная > Контакты
Breadcrumbs::register('backend.contact', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.home');
    $breadcrumbs->push('Контакты', route('backend.contact'));
});
// Главная > Контакты > Редактировать форму
Breadcrumbs::register('backend.contact.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.contact');
    $breadcrumbs->push('Редактирование формы', route('backend.contact.edit'));
});

/**
 * Настройки
 */
Breadcrumbs::register('backend.config', function($breadcrumbs)
{
    $breadcrumbs->parent('backend.home');
    $breadcrumbs->push('Настройки', route('backend.config'));
});