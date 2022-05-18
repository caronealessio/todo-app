<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenDate;
use Cake\Validation\Validator;

class MemosTable extends Table{

    
    
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }

    public function validationDefault(Validator $validator): Validator
    {
         
        $validator
            ->notEmptyString('title')
            ->minLength('title', 10)
            ->maxLength('title', 255)

            ->notEmptyString('body')
            ->minLength('body', 10)

            ->notEmptyDateTime('expiration_date')
            ->add('expiration_date', 'custom', [
                'rule' => function ($value, $context) {                           
                    $now = FrozenDate::now();
                    $date = new \DateTime($value);
                    if ($date < $now) 
                    {
                        return false;
                    }
                    return true;
                },
                'message' => 'Date not valid.'
            ]);

        return $validator;
    }

    
}