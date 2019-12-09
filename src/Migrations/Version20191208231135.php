<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191208231135 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE appartement_types');
        $this->addSql('ALTER TABLE types ADD appartement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE types ADD CONSTRAINT FK_59308930E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id)');
        $this->addSql('CREATE INDEX IDX_59308930E1729BBA ON types (appartement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appartement_types (appartement_id INT NOT NULL, types_id INT NOT NULL, INDEX IDX_A442EAB1E1729BBA (appartement_id), INDEX IDX_A442EAB18EB23357 (types_id), PRIMARY KEY(appartement_id, types_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appartement_types ADD CONSTRAINT FK_A442EAB18EB23357 FOREIGN KEY (types_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_types ADD CONSTRAINT FK_A442EAB1E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE types DROP FOREIGN KEY FK_59308930E1729BBA');
        $this->addSql('DROP INDEX IDX_59308930E1729BBA ON types');
        $this->addSql('ALTER TABLE types DROP appartement_id');
    }
}
