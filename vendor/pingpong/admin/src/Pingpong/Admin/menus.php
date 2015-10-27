<?php

Menu::create('admin-menu', function ($menu)
{
    if(Auth::check())
    {
        $menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
        $menu->route('admin.home', 'Dashboard', [], ['icon' => 'fa fa-dashboard']);
        
        if(Auth::user()->is('admin'))
        {
            $menu->dropdown('Users', function ($sub)
            {
                $sub->route('admin.users.index', 'All Users');
                $sub->route('admin.users.create', 'Add New User');
                $sub->divider();
                $sub->route('admin.roles.index', 'Roles');
                $sub->route('admin.permissions.index', 'Permissions');
            }, ['icon' => 'fa fa-users']);
        }

        if(Auth::user()->is('manager') or Auth::user()->is('admin'))
        {
            $menu->dropdown('Projects', function ($sub)
            {
                $sub->route('admin.projects.index', 'All Projects');
                $sub->route('admin.projects.create', 'Add New Project');
            }, ['icon' => 'fa fa-th']);
        }

        if(Auth::user()->is('manager') or Auth::user()->is('admin'))
        {
            $menu->dropdown('Defects', function ($sub)
            {
                $sub->route('admin.defects.index', 'All Defects');
                $sub->route('admin.defects.create', 'Add New Defect');
            }, ['icon' => 'glyphicon glyphicon-exclamation-sign']);
        }
    }
});