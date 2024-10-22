<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SelectValues Model
 *
 * @method \App\Model\Entity\SelectValue newEmptyEntity()
 * @method \App\Model\Entity\SelectValue newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\SelectValue> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SelectValue get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\SelectValue findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\SelectValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\SelectValue> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SelectValue|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\SelectValue saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\SelectValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SelectValue>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SelectValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SelectValue> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SelectValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SelectValue>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SelectValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SelectValue> deleteManyOrFail(iterable $entities, array $options = [])
 */
class SelectValuesTable extends Table
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

        $this->setTable('select_values');
        $this->setDisplayField('select_key');
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
            ->scalar('select_key')
            ->maxLength('select_key', 255)
            ->requirePresence('select_key', 'create')
            ->notEmptyString('select_key');

        $validator
            ->scalar('select_value')
            ->maxLength('select_value', 255)
            ->requirePresence('select_value', 'create')
            ->notEmptyString('select_value');

        return $validator;
    }
}
