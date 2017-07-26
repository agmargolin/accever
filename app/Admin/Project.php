<?php
use App\Project;
use App\User;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Project::class, function (ModelConfiguration $model) {
    $model->setTitle('Проекты');
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Название проэкта')->setWidth('400px'),
            AdminColumn::text('type')->setLabel('Тип'),
            AdminColumn::text('description')->setLabel('Описание'),
            AdminColumn::text('updated_at')->setLabel('Песледнее изминение'),
        ]);
        $display->paginate(15);
        return $display;
    });
 $model->onCreateAndEdit(function () {
     $form = AdminForm::panel()->addBody(
         AdminFormElement::text('name', 'Название проэкта'),
         AdminFormElement::text('type', 'Тип'),
         AdminFormElement::text('description', 'Описание')
         //AdminFormElement::multiselect('users', 'Пользователи')->setModelForOptions(new User())->setDisplay('name')
     );
     return $form;
 });
});