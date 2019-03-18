<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190129131509 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advert_skill DROP FOREIGN KEY FK_5619F91BD07ECCB6');
        $this->addSql('DROP INDEX IDX_5619F91BD07ECCB6 ON advert_skill');
        $this->addSql('ALTER TABLE advert_skill DROP advert_id');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477D7277BC3');
        $this->addSql('DROP INDEX IDX_5E3DE477D7277BC3 ON skill');
        $this->addSql('ALTER TABLE skill DROP advert_skill_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advert_skill ADD advert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advert_skill ADD CONSTRAINT FK_5619F91BD07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id)');
        $this->addSql('CREATE INDEX IDX_5619F91BD07ECCB6 ON advert_skill (advert_id)');
        $this->addSql('ALTER TABLE skill ADD advert_skill_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477D7277BC3 FOREIGN KEY (advert_skill_id) REFERENCES advert_skill (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477D7277BC3 ON skill (advert_skill_id)');
    }
}
