<?php

// PackageManager::load('admin-default')
//    ->css('extend', resources_url('css/extend.css'));
PackageManager::add('jquery')
    ->js('jquery.js', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');


PackageManager::add('all.min')
    ->js('all.min', resources_url('js/all.min.js'));

PackageManager::add('bootstrap.min')
    ->js('extend', resources_url('js/bootstrap.min.js'));

PackageManager::add('bootstrap-multiselect')
    ->js('extend', resources_url('js/bootstrap-multiselect.js'));

Meta::loadPackage(['jquery', 'bootstrap-multiselect', 'bootstrap.min', 'all.min']);