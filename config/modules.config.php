<?php


return [
    Zend\Expressive\ConfigProvider::class,
    Zend\Component\ConfigProvider::class,
    Zend\Validator\ConfigProvider::class,
    Zend\Router\ConfigProvider::class,
    Zend\I18n\ConfigProvider::class,
    Zend\Filter\ConfigProvider::class,
    Zend\Navigation\ConfigProvider::class,
    Zend\Form\ConfigProvider::class,
    Zend\InputFilter\ConfigProvider::class,    
    Zend\Hydrator\ConfigProvider::class,
    Zend\Db\ConfigProvider::class,
    CodingMatters\Persistence\ConfigProvider::class,
    Application\ConfigProvider::class,
    Site\ConfigProvider::class,
];
