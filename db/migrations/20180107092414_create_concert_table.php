<?php


use Phinx\Migration\AbstractMigration;

class CreateConcertTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('concerts')
            ->addColumn('title', 'string', ['limit' => 50])
            ->addColumn('subtitle', 'string', ['limit' => 50])
            ->addColumn('date', 'datetime')
            ->addColumn('ticket_price', 'integer')
            ->addColumn('venue', 'string', ['limit' => 50])
            ->addColumn('venue_address', 'string', ['limit' => 100])
            ->addColumn('city', 'string', ['limit' => 100])
            ->addColumn('state', 'string', ['limit' => 2])
            ->addColumn('zip', 'string', ['limit' => 5])
            ->addColumn('additional_information', 'string', ['limit' => 100])
            ->save();
    }
}
