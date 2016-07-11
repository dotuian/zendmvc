<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class News implements InputFilterAwareInterface {

    public $id;
    public $title;
    public $content;
    
    protected $inputFilter;


    // 对数组数据进行转换或都说是提取数组数据
    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->content = (isset($data['content'])) ? $data['content'] : null;
    }
    
    // 将类属性转化为一个关联数组，方便后续的使用
    public function getArrayCopy() {
        return get_object_vars($this);
    }
    
    /**
     * 实现 InputFilterAwareInterface 的接口方法。
     * @return type
     */
    public function getInputFilter() {
        if (!$this->inputFilter) {
            
            // 实例化一个InputFilter过滤器
            $this->inputFilter = new InputFilter();
            // 实例化一个InputFactory 输入工厂
            $factory = new InputFactory();

            // 创建过滤规则并将附加到InputFilter上,
            // 规则内容：name为id的标签为必填项，并且限制为整形输入
            $this->inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));
            
            // 建过滤规则并将附加到InputFilter上,此处的过滤规则为一个过滤链，
            // 规则内容：name 为 content的标签为必填项，
            // 并对其他输入进行去HTML标签(StripTags)和去空格(StringTrim)处理,
            // 同时对输入内容进一步校验，校验规则为将输入内容限制为utf-8，同时长度为5~100的个字符。
            $this->inputFilter->add($factory->createInput(array(
                        'name' => 'title',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 5,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));
            
            $this->inputFilter->add($factory->createInput(array(
                        'name' => 'content',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 5,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));
        }

        return $this->inputFilter;
    }
    
    /**
     * 实现 InputFilterAwareInterface 的接口方法。
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception('Not used');
    }

}
