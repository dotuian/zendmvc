<?php
// module/Album/src/Model/Album.php:
namespace Album\Model;

// Add the following import statements:
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Album implements InputFilterAwareInterface
{
    public $id;
    public $artist;
    public $title;

    // Add this property:
    private $inputFilter;
    
    // 数据转换
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->artist = !empty($data['artist']) ? $data['artist'] : null;
        $this->title  = !empty($data['title']) ? $data['title'] : null;
    }

    // 克隆对象内属性
    public function getArrayCopy()
    {
//        return [
//            'id'     => $this->id,
//            'artist' => $this->artist,
//            'title'  => $this->title,
//        ];
        return get_object_vars($this);
    }

    //过滤器
    public function getInputFilter() {

        if (!$this->inputFilter) {
            $this->inputFilter = new InputFilter();

            $factory = new InputFactory();

            $this->inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

            $this->inputFilter->add($factory->createInput(array(
                        'name' => 'artist',
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
        }

        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

}