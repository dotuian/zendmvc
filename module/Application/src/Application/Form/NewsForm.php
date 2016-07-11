<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Form;

use Zend\Form\Form;

class NewsForm extends Form {

    // 构造函数，$name 为表单名称
    public function __construct($name = 'news') {
        
        parent::__construct($name);
        
        // 设置表单属性
        $this->setAttribute('method', 'post');
        
        // 添加一个表单隐藏域，作为新闻ID
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));

        // 添加一个input 标签，作为新闻标题输入
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title'
            ),
        ));
        
        // 添加一个input标签，作为新闻内容输入
        $this->add(array(
            'name' => 'content',
            'type' => 'Text',
            'options' => array(
                'label' => 'Content'
            ),
        ));
        
        // 添加一个提交按钮
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submit'
            ),
        ));
    }

}
