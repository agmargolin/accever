<?php

use SleepingOwl\Admin\Navigation\Page;

use App\Access;
use App\User;
use App\Log;
use App\Project;
use Illuminate\Http\Request;
use SleepingOwl\Admin\Model\ModelConfiguration;

use Illuminate\Support\Facades\Auth;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

/* menu is different for diferent user roles */

    return [
        [
            'title' => 'Dashboard',
            'icon' => 'fa fa-dashboard',
            'url' => route('admin.dashboard'),
        ],

        [
            'title' => 'Пользователи',
            'icon' => 'fa fa-group',
            'url' => 'admin/users',
            'pages' => [
                [
                    'title' => 'Пользователи',
                    'icon' => 'fa fa-group',
                    'url' => 'admin/users',
                ],
                [
                    'title' => 'Роли',
                    'icon' => 'fa fa-graduation-cap',
                    'url' => 'admin/roles',
                    'accessLogic' => function ($page) {
                        $user = Sentinel::getUser();
                        return $user->inRole('admin');
                    },
                ],
                [
                    'title' => 'Права',
                    'icon' => 'fa fa-key',
                    'url' => 'admin/permits',
                    'accessLogic' => function ($page) {
                        $user = Sentinel::getUser();
                        return $user->inRole('admin');
                    },
                ],
            ]
        ],


        [
            'title' => 'Доступы',
            'icon' => 'fa fa-low-vision',
            'pages' => [

                (new Page(\App\Project::class))
                    ->setTitle('Проекты')
                    ->setPriority(50)
                    ->setIcon('fa fa-file-text-o')
                    ->setUrl('/admin/projects')
                    ->setAccessLogic(function (Page $page) {
                        $user = Sentinel::getUser();
                        if($user->inRole('admin') || $user->inRole('evergreen')) {
                            return true;
                        }
                        return false;
                    }),
                (new Page(\App\Package::class))
                    ->setTitle('Пакеты')
                    ->setPriority(50)
                    ->setIcon('fa fa-cube')
                    ->setUrl('admin/packages')
                    ->setAccessLogic(function (Page $page) {
                        $user = Sentinel::getUser();
                        return $user->inRole('admin');
                    }),
                (new Page(\App\Access::class))
                    ->setTitle('Доступы')
                    ->setPriority(50)
                    ->setIcon('fa fa-low-vision')
                    ->setUrl('/admin/accesses')
                    ->setAccessLogic(function (Page $page) {
                        $user = Sentinel::getUser();
                        if(!$user->inRole('banned')) {
                            return true;
                        }
                        return false;
                    })
            ]
        ],


        [
            'title' => 'Журнал',
            'icon' => 'fa fa-book',
            'url' => '/admin/logs',
            'accessLogic' => function ($page) {
                $user = Sentinel::getUser();
                return $user->inRole('admin');
            },
        ],

        [
            'title' => 'Выйти',
            'icon' => 'fa fa-sign-out',
            'url' => '/logout',
        ],

    ];
//}



