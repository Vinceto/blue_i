<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NavBarItems Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\NavBarItem newEmptyEntity()
 * @method \App\Model\Entity\NavBarItem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\NavBarItem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NavBarItem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\NavBarItem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\NavBarItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\NavBarItem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\NavBarItem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\NavBarItem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\NavBarItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\NavBarItem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\NavBarItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\NavBarItem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\NavBarItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\NavBarItem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\NavBarItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\NavBarItem> deleteManyOrFail(iterable $entities, array $options = [])
 */
class NavBarItemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('nav_bar_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        $validator
            ->nonNegativeInteger('role_id')
            ->allowEmptyString('role_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }
}
