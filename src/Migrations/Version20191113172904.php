<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191113172904 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appartement (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, quartier VARCHAR(255) NOT NULL, prix INT NOT NULL, created_at DATETIME NOT NULL, ville VARCHAR(255) NOT NULL, caracteristiques LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', annee_de_construction INT DEFAULT NULL, douches VARCHAR(255) DEFAULT NULL, parking INT DEFAULT NULL, garage INT DEFAULT NULL, surface DOUBLE PRECISION DEFAULT NULL, chambres INT DEFAULT NULL, etages INT DEFAULT NULL, piscines INT DEFAULT NULL, salons INT DEFAULT NULL, balcons INT DEFAULT NULL, cuisines INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_71A6BD8D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appartement_types (appartement_id INT NOT NULL, types_id INT NOT NULL, INDEX IDX_A442EAB1E1729BBA (appartement_id), INDEX IDX_A442EAB18EB23357 (types_id), PRIMARY KEY(appartement_id, types_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, appartement_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, textes VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, votes INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_D9BEC0C4E1729BBA (appartement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE get_touche (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, appartement_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_876E0D9E1729BBA (appartement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero INT NOT NULL, dates VARCHAR(255) NOT NULL, dates2 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_appartement (reservation_id INT NOT NULL, appartement_id INT NOT NULL, INDEX IDX_BDCA60D1B83297E7 (reservation_id), INDEX IDX_BDCA60D1E1729BBA (appartement_id), PRIMARY KEY(reservation_id, appartement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types (id INT AUTO_INCREMENT NOT NULL, types VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE appartement_types ADD CONSTRAINT FK_A442EAB1E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_types ADD CONSTRAINT FK_A442EAB18EB23357 FOREIGN KEY (types_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id)');
        $this->addSql('ALTER TABLE reservation_appartement ADD CONSTRAINT FK_BDCA60D1B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_appartement ADD CONSTRAINT FK_BDCA60D1E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appartement_types DROP FOREIGN KEY FK_A442EAB1E1729BBA');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4E1729BBA');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9E1729BBA');
        $this->addSql('ALTER TABLE reservation_appartement DROP FOREIGN KEY FK_BDCA60D1E1729BBA');
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8D12469DE2');
        $this->addSql('ALTER TABLE reservation_appartement DROP FOREIGN KEY FK_BDCA60D1B83297E7');
        $this->addSql('ALTER TABLE appartement_types DROP FOREIGN KEY FK_A442EAB18EB23357');
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE appartement_types');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE get_touche');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_appartement');
        $this->addSql('DROP TABLE types');
    }
}
