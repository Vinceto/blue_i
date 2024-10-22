<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IdiemGroup Model
 *
 * @method \App\Model\Entity\IdiemGroup newEmptyEntity()
 * @method \App\Model\Entity\IdiemGroup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\IdiemGroup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IdiemGroup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\IdiemGroup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\IdiemGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\IdiemGroup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\IdiemGroup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\IdiemGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\IdiemGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IdiemGroup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\IdiemGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IdiemGroup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\IdiemGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IdiemGroup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\IdiemGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IdiemGroup> deleteManyOrFail(iterable $entities, array $options = [])
 */
class IdiemGroupTable extends Table
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

        $this->setTable('idiem_group');
        $this->setDisplayField('valor');
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
            ->scalar('valor')
            ->maxLength('valor', 255)
            ->requirePresence('valor', 'create')
            ->notEmptyString('valor');

        return $validator;
    }
}
