<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit' => 20]);
        $table->addColumn('email', 'string', ['limit' => 100]);
        $table->addColumn('name', 'string', ['limit' => 255]);
        $table->addColumn('age', 'integer');
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex('username', ['unique' => true]);
        $table->addIndex('email', ['unique' => true]);

        $table->create();
    }
}
