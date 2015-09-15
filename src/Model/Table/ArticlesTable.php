<?php
namespace App\Model\Table;

use App\Model\Entity\Article;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Articles Model
 *
 */
class ArticlesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('articles');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');
        $this->addBehavior('Proffer.Proffer', [
            'photo' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'photo_dir',   // The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => ['w' => 200, 'h' => 200],   // Define the size and prefix of your thumbnails
                    'portrait' => ['w' => 400, 'h' => 100, 'crop' => true],     // Crop will crop the image as well as resize it
                    'long' => ['w' => 400, 'h' => 200],
                ],
                'thumbnailMethod' => 'gd'  // Options are Imagick, Gd or Gmagick
            ]
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        return $validator;
    }
    public function isOwnedBy($articleId, $userId)
    {
        return $this->exists(['id' => $articleId, 'user_id' => $userId]);
    }
    public function searchConfiguration()
    {
        $search = new Manager($this);
        $search
        ->value('author', [
            'label' => '',
            'field' => $this->aliasField('author'),
            'placeholder' => 'Search by Author'
        ])
        ->like('q', [
            'label' => '',
            'placeholder' => 'Search by Content',    
            'before' => true,
            'after' => true,
            'field' => [$this->aliasField('title'), $this->aliasField('body')]
        ]);
        return $search;
    }
}
