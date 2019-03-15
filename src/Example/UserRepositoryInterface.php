<?php

namespace EdmondsCommerce\Generic\Example;

use EdmondsCommerce\Generic\Example\Collections\VectorUser;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface UserRepositoryInterface
{
    /**
     * @return \EdmondsCommerce\Generic\Example\Collections\VectorUser
     */
    public function findAll(): VectorUser;
}
