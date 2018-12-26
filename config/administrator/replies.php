<?php

use App\Models\Reply;

return [
    'title'   => '回复',
    'single'  => '回复',
    'model'   => Reply::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'content' => [
            'title'    => '内容',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:220px">' . $value . '</div>';
            },
        ],
        'user' => [
            'title'    => '作者',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . $model->user->name;
                return model_link($value, $model->user);
            },
        ],
        'topic' => [
            'title'    => '话题',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:260px">' . model_admin_link($model->topic->title, $model->topic) . '</div>';
            },
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'topic' => [
            'title'              => '话题',
            'type'               => 'relationship',
            'name_field'         => 'title',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', title)"),
            'options_sort_field' => 'id',
        ],
        'content' => [
            'title'    => '回复内容',
            'type'     => 'textarea',
        ],
    ],
    'filters' => [
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'topic' => [
            'title'              => '话题',
            'type'               => 'relationship',
            'name_field'         => 'title',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', title)"),
            'options_sort_field' => 'id',
        ],
        'content' => [
            'title'    => '回复内容',
        ],
    ],
    'rules'   => [
        'content' => 'required'
    ],
    'messages' => [
        'content.required' => '请填写回复内容',
    ],
];
