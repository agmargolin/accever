<?php

use App\Access;
use App\User;
use App\Log;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use SleepingOwl\Admin\Model\ModelConfiguration;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


AdminSection::registerModel(Access::class, function (ModelConfiguration $model) {
    $model->setTitle('Доступы');

    $model->onDisplay(function (Request $request) {
        $display = AdminDisplay::datatables()
            ->setColumns([
                AdminColumn::custom('Проект', function(\Illuminate\Database\Eloquent\Model $model) {
            return $model->projects->name . ' (' . $model->projects->id . ')';

        }),
                AdminColumn::link('service_name')->setLabel('Название'),
                AdminColumn::url('url', '')->setWidth('20px')->setLinkAttributes(['target' => "_blank"]),
                AdminColumn::text('url', 'URL'),
                AdminColumn::text('login')->setLabel('Login'),
                //AdminColumn::text('password')->setLabel('Пароль'),
                AdminColumn::custom('Пароль', function(\Illuminate\Database\Eloquent\Model $model) {

                    return $model->decryptPassword($model->password); //decrypt password from DB to show it user

                }),
                AdminColumn::text('port', 'Порт'),
                AdminColumn::text('description')->setLabel('Описание')
        ]);

        $this->user_id = $request->user()->id;

        $display->getApply()->push(function ($query) { // set display only those accesses that allow to this user
            $query->select('*')
                  ->join('accesses_users', 'id', '=', 'accesses_users.access_id')

                ->where('accesses_users.user_id', $this->user_id);
        });

        $display->paginate(15);

        $display->setColumnFilters([ //todo sort logic of each column ?

            AdminColumnFilter::select(new Project, 'name')->setDisplay('name')->setPlaceholder('Select Project')->setColumnName('project_id'),
            null,
            null,
            null,
            null,
            null,
            null,
            null

        ]);

        return $display;
    });

    $model->onCreateAndEdit(function (Request $request) {

        $admin = Sentinel::getUser()->inRole('admin');

        $form = AdminForm::panel()->addBody(
            AdminFormElement::select('project_id', 'Проект')->setModelForOptions(new Project())->setDisplay('name'),
            AdminFormElement::select('scope', 'Область видимости')->setOptions([1 => 'global', 2 => 'personal']),
            AdminFormElement::select('type', 'Тип')->setOptions(['ssh', 'sftp', 'ftp', 'adminka', 'service', 'email', 'smtp', 'pop']),
            AdminFormElement::text('url', 'URL'),
            AdminFormElement::text('service_name', 'Название сервиса'),
            AdminFormElement::text('login', 'Login'),
            AdminFormElement::custom(function (\Illuminate\Database\Eloquent\Model $model) {
                //$model->password = request()->password;
            })->setDisplay(function (\Illuminate\Database\Eloquent\Model $model) {
                return view('admin.mycolumn', [
                    'model' => $model
                ]);
            }),
            AdminFormElement::text('port', 'Порт'),
            AdminFormElement::textarea('description', 'Описание')
        );
        

        if($admin) { // difernt inputs for different user roles
            $form = AdminForm::panel()->addBody(
                AdminFormElement::select('project_id', 'Проект')->setModelForOptions(new Project())->setDisplay('name'),
                AdminFormElement::select('scope', 'Область видимости')->setOptions([1 => 'global', 2 => 'personal']),
                AdminFormElement::select('type', 'Тип')->setOptions(['ssh', 'sftp', 'ftp', 'adminka', 'service', 'email', 'smtp', 'pop']),
                AdminFormElement::text('url', 'URL'),
                AdminFormElement::text('service_name', 'Название сервиса'),
                AdminFormElement::text('login', 'Login'),
                //AdminFormElement::text('password', 'Пароль'),
                AdminFormElement::custom(function (\Illuminate\Database\Eloquent\Model $model) {
                    //$model->password = request()->password;
                })->setDisplay(function (\Illuminate\Database\Eloquent\Model $model) {
                            return view('admin.mycolumn', [
                                'model' => $model
                            ]);
                        }),
                AdminFormElement::text('port', 'Порт'),
                AdminFormElement::textarea('description', 'Описание'),
                AdminFormElement::select('author_id', 'Автор')->setModelForOptions(new User())->setDisplay('last_name'),
                AdminFormElement::datetime('updated_at')->setLabel('Песледнее изминение'),
                AdminFormElement::multiselect('users', 'Пользователи')->setModelForOptions(new User())->setDisplay('last_name')


            );
        }
        $access = new Access;
        $encrypted = $access->encryptPassword($request->password); //encrypt password before input in DB
        $request->merge(array('password' => $encrypted));

        if($request->isMethod('post')) {//write log record on each action
            app('App\Http\Controllers\LogController')->add($request);
        }

        return $form;
    });


    $model->setRedirect(['create' => '/', 'edit' => 'display']);

    //$model->enableAccessCheck(); todo
});