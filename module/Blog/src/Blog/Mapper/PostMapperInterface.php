<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Mapper;

use Blog\Model\PostInterface;

interface PostMapperInterface {

    /**
     * @param int|string $id
     * @return PostInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);

    /**
     * @return array|PostInterface[]
     */
    public function findAll();
    
     /**
      * @param PostInterface $postObject
      *
      * @param PostInterface $postObject
      * @return PostInterface
      * @throws \Exception
      */
     public function save(PostInterface $postObject);
     
     /**
      * @param PostInterface $postObject
      *
      * @return bool
      * @throws \Exception
      */
     public function delete(PostInterface $postObject);
}
