<?php
/**
 * Astashenkov
**/

return [
    // Site
    '/'                              => 'frontend/site/index',
    'about'                          => 'frontend/site/about',
    'contact'                        => 'frontend/site/contact',
    'index'                          => 'frontend/site/index',
    'login'                          => 'frontend/site/login',
    'logout'                         => 'frontend/site/logout',
    'signup'                         => 'frontend/site/signup',
    'site/login'                     => 'backend/admin/login',
    // Blog
    '/blog'                          => 'frontend/blog/list',
    '/blog/post/<id:\d+>'            => 'frontend/blog/post',
    // Backend
    '/adminpanel'                    => 'backend/blog/index',
    '<controller>/<action>/<id:\d+>' => 'frontend/<controller>/<action>',
];