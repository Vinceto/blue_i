<div id="user_registration_form" class="users form content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Registrar Usuario') ?></legend>
        <?php
            echo $this->Form->control('first_name', ['label' => 'Nombre']);
            echo $this->Form->control('last_name', ['label' => 'Apellido']);
            echo $this->Form->control('username', ['label' => 'Cédula del Usuario']);
            echo $this->Form->control('email', ['label' => 'Correo electrónico']);
            echo $this->Form->control('password', ['label' => 'Contraseña']);
            echo $this->Form->control('role_id', ['options' => $roles, 'label' => 'Rol']);
            //echo $this->Form->control('status_id', ['options' => $statuses, 'label' => 'Estado','value' => 1, 'disabled' ]);
            //echo $this->Form->hidden('status_id', ['options' => $statuses, 'label' => 'Estado','value' => 1]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Registrar')) ?>
    <?= $this->Form->end() ?>
</div>

<script src="/webroot/js/rutValidator.js"></script>
<script>
    // Asignar la validación al formulario y al campo del RUT
    validarRutEnFormulario('user_registration_form', 'username');
</script>