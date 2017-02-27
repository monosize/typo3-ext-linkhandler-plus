<?php

$EM_CONF[$_EXTKEY] = [
   'title' => 'LinkHandler Plus ',
   'description' => 'Extended the Linkhandler to handle tel: url\'s',
   'category' => 'misc',
   'version' => '0.1.0',
   'state' => 'stable',
   'uploadfolder' => false,
   'createDirs' => '',
   'clearcacheonload' => true,
   'author' => 'Frank Rakow',
   'author_email' => 'frank.rakow@gmail.com',
   'author_company' => '',
   'constraints' => [
      'depends' => [
         'typo3' => '8.6.0-8.9.99',
      ],
      'conflicts' => [],
      'suggests' => [],
   ],
   'suggests' => [],
   'autoload'         => [
       'psr-4' => [
           "Monosize\\LinkHandler\\Plus\\" => 'Classes',
       ],
   ],
];
