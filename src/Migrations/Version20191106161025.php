<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106161025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_96A50CD7BFCDF877');
        $this->addSql('DROP INDEX IDX_96A50CD74584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__selection AS SELECT id, my_order_id, product_id, quantity FROM selection');
        $this->addSql('DROP TABLE selection');
        $this->addSql('CREATE TABLE selection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, my_order_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_96A50CD7BFCDF877 FOREIGN KEY (my_order_id) REFERENCES "order" (number) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_96A50CD74584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO selection (id, my_order_id, product_id, quantity) SELECT id, my_order_id, product_id, quantity FROM __temp__selection');
        $this->addSql('DROP TABLE __temp__selection');
        $this->addSql('CREATE INDEX IDX_96A50CD7BFCDF877 ON selection (my_order_id)');
        $this->addSql('CREATE INDEX IDX_96A50CD74584665A ON selection (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_96A50CD7BFCDF877');
        $this->addSql('DROP INDEX IDX_96A50CD74584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__selection AS SELECT id, my_order_id, product_id, quantity FROM selection');
        $this->addSql('DROP TABLE selection');
        $this->addSql('CREATE TABLE selection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, my_order_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO selection (id, my_order_id, product_id, quantity) SELECT id, my_order_id, product_id, quantity FROM __temp__selection');
        $this->addSql('DROP TABLE __temp__selection');
        $this->addSql('CREATE INDEX IDX_96A50CD7BFCDF877 ON selection (my_order_id)');
        $this->addSql('CREATE INDEX IDX_96A50CD74584665A ON selection (product_id)');
    }
}
