<?php
use App\Package;
use App\Access;
use App\User;
use SleepingOwl\Admin\Model\ModelConfiguration;
use Illuminate\Http\Request;

AdminSection::registerModel(Package::class, function (ModelConfiguration $model) {
    $model->setTitle('Пакеты');
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Название пакета')->setWidth('400px'),
            AdminColumn::text('type')->setLabel('Тип'),
            AdminColumn::text('description')->setLabel('Описание'),
            AdminColumn::text('updated_at')->setLabel('Песледнее изминение'),
        ]);
        $display->paginate(15);
        return $display;
    });
 $model->onCreateAndEdit(function (Request $request) {
     $form = AdminForm::panel()->addBody(
         AdminFormElement::text('name', 'Название пакета'),
         AdminFormElement::text('type', 'Тип'),
         AdminFormElement::text('description', 'Описание'),
         AdminFormElement::multiselect('accesses', 'Доступы')->setModelForOptions(new Access())->setDisplay('service_name'),
         AdminFormElement::multiselect('users', 'Пользователи')->setModelForOptions(new User())->setDisplay('last_name')

     );

     if($request->isMethod('post')) { // add accesses from current package to users
         app('App\Http\Controllers\userController')->addPackage($request);
     }


     return $form;
 });
});