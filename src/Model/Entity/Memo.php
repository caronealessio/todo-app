<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Memo extends Entity{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}