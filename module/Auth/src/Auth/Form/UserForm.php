<?php

namespace Auth\Form;

use Zend\Form\Form;

class UserForm extends Form {

    public function __construct($name = null) {
        // We will ignore the name provided to the constructor
        parent::__construct('album');

        $this->setAttribute('method', 'post');

        $this->add([
            'name' => 'username',
            'type' => 'text',
            'options' => [
                'label' => 'username',
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'password',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Login',
                'id' => 'submit',
            ],
        ]);
    }

}
