<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $role_id
 * @property int|null $status_id
 * @property \Cake\I18n\DateTime $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 * @property \Cake\I18n\DateTime|null $deleted_at
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Status $status
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'role_id' => true,
        'status_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
        'role' => true,
        'status' => true,
    ];

    protected array $_virtual = ['role_name', 'status_name'];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return null;
    }

    protected function _getRoleName(): ?string
    {
        if (isset($this->role_id)) {
            $rolesTable = TableRegistry::getTableLocator()->get('Roles');
            $role = $rolesTable->get($this->role_id);
            return $role ? $role->name : null;
        }
        return null;
    }

    protected function _getStatusName(): ?string
    {
        if (isset($this->status_id)) {
            $statusesTable = TableRegistry::getTableLocator()->get('Statuses');
            $status = $statusesTable->get($this->status_id);
            return $status ? $status->name : null;
        }
        return null;
    }

    protected function _setStatusId(int $status_id): ?int
{
    if ($status_id > 0) {
        $statusesTable = TableRegistry::getTableLocator()->get('Statuses');
        $status = $statusesTable->find()->where(['id' => $status_id])->first();

        if ($status) {
            return $status_id;
        }
    }
    
    return null;
}


    public function validationDefault(Validator $validator): Validator{
        $validator
            ->add('username', 'validRut', [
                'rule' => function ($value, $context) {
                    return $this->validateRut($value);
                },
                'message' => 'Por favor, ingrese un RUT chileno válido.'
            ]);

        // Otras validaciones aquí...

        return $validator;
    }

    private function validateRut($rut){
        // Implementar la lógica de validación de RUT chileno
        // Ejemplo: Expresión regular para verificar el formato
        if (preg_match('/^\d{1,2}\.\d{3}\.\d{3}-[0-9Kk]$/', $rut)) {
            // Valida dígito verificador, si es correcto retornar true
            return $this->validarDigitoVerificador($rut);
        }
        return false;
    }

    private function validarDigitoVerificador($rut){
        // Lógica para calcular el dígito verificador del RUT
        $rut = preg_replace('/[^0-9Kk]/', '', $rut); // Remover puntos y guiones
        $dv = substr($rut, -1); // Obtener dígito verificador
        $numero = substr($rut, 0, -1); // Obtener número del RUT
        
        // Calcular dígito verificador
        $factor = 2;
        $suma = 0;
        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $suma += $numero[$i] * $factor;
            $factor = $factor == 7 ? 2 : $factor + 1;
        }
        $resto = 11 - ($suma % 11);
        $dvCalculado = $resto == 11 ? '0' : ($resto == 10 ? 'K' : $resto);

        return strtoupper($dv) == strtoupper($dvCalculado);
    }
}