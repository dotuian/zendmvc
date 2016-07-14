<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Service;

use Blog\Model\PostInterface;

 interface PostServiceInterface
 {
     /**
      * 应该会分会所有博客帖子集，以便我们对其遍历。数组中的每个条目应该都是
      * \Blog\Model\PostInterface 接口的实现
      *
      * @return array|PostInterface[]
      */
     public function findAllPosts();

     /**
      * 应该会返回单个博客帖子
      *
      * @param  int $id 应该被返回的帖子的标识符
      * @return PostInterface
      */
     public function findPost($id);

     /**
      * 应该会保存给出了的 PostInterface 实现并且返回。如果是已有的帖子那么帖子
      * 应该被更新，如果是新帖子则应该去创建。
      *
      * @param  PostInterface $blog
      * @return PostInterface
      */
     public function savePost(PostInterface $blog);

     /**
      * 应该删除给出的 PostInterface 的一个实现，如果删除成功就返回 true
      * 否则返回 false.
      *
      * @param  PostInterface $blog
      * @return bool
      */
     public function deletePost(PostInterface $blog);
 }