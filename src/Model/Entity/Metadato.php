<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Metadato Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $label
 * @property int|null $group_id
 * @property int|null $service_id
 * @property string $tag
 * @property array|null $selectData
 * @property bool $visibility
 * @property bool $is_required
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 * @property \Cake\I18n\DateTime|null $deleted_at
 */
class Metadato extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'label' => true,
        'group_id' => true,
        'service_id' => true,
        'tag' => true,
        'selectData' => true,
        'visibility' => true,
        'is_required' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
    ];
}
