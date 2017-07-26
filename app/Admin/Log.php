<?php
use App\Access;
use App\Log;
use App\User;
use App\Project;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Log::class, function (ModelConfiguration $model) {
    $model->setTitle('Журнал изменений');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()
            ->setColumns([
                AdminColumn::custom('Проект', function(\Illuminate\Database\Eloquent\Model $model) {
                    return $model->projects->name . ' (' . $model->projects->id . ')';
                }),
                AdminColumn::text('scope')->setLabel('Область видимости'),
                AdminColumn::text('type')->setLabel('Тип'),
                AdminColumn::text('url')->setLabel('url'),
                AdminColumn::text('service_name')->setLabel('Название'),
                AdminColumn::text('login')->setLabel('Login'),
                AdminColumn::text('password')->setLabel('Пароль'),
                AdminColumn::text('port')->setLabel('Порт'),
                AdminColumn::text('authors.last_name')->setLabel('Создатель'),
               // AdminColumn::text('changers.last_name')->setLabel('Автор изминения'),
                AdminColumn::text('updated_at')->setLabel('Дата изминения'),
        ]);
        $display->paginate(15);

        $display->setColumnFilters([

            AdminColumnFilter::select(new Project, 'name')->setDisplay('name')->setPlaceholder('Select Project')->setColumnName('project_id'),
            null,
            null,
            AdminColumnFilter::text('url'),
            null,
            null,
            null,
            null,
            null,
            null

        ]);

        return $display;
    });
    

});