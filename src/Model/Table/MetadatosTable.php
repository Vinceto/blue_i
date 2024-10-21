<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Metadatos Model
 *
 * @method \App\Model\Entity\Metadato newEmptyEntity()
 * @method \App\Model\Entity\Metadato newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Metadato> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Metadato get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Metadato findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Metadato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Metadato> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Metadato|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Metadato saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Metadato>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metadato>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Metadato>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metadato> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Metadato>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metadato>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Metadato>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metadato> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetadatosTable extends Table
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

        $this->setTable('metadatos');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('label')
            ->maxLength('label', 255)
            ->allowEmptyString('label');

        $validator
            ->nonNegativeInteger('group_id')
            ->allowEmptyString('group_id');

        $validator
            ->nonNegativeInteger('service_id')
            ->allowEmptyString('service_id');

        $validator
            ->scalar('tag')
            ->requirePresence('tag', 'create')
            ->notEmptyString('tag');

        $validator
            ->allowEmptyString('selectData');

        $validator
            ->boolean('visibility')
            ->notEmptyString('visibility');

        $validator
            ->boolean('is_required')
            ->notEmptyString('is_required');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        $validator
            ->dateTime('deleted_at')
            ->allowEmptyDateTime('deleted_at');

        return $validator;
    }
}
