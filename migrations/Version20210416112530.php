<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416112530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, section_id INT NOT NULL, nom VARCHAR(30) NOT NULL, INDEX IDX_8F87BF96D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, texte LONGTEXT NOT NULL, date DATE NOT NULL, INDEX IDX_67F068BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, matiere_id INT NOT NULL, quizz_id INT NOT NULL, nom VARCHAR(30) NOT NULL, INDEX IDX_FDCA8C9CBAB22EE9 (professeur_id), INDEX IDX_FDCA8C9CF46CD258 (matiere_id), UNIQUE INDEX UNIQ_FDCA8C9CBA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fullname (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_user (matiere_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FE415017F46CD258 (matiere_id), INDEX IDX_FE415017A76ED395 (user_id), PRIMARY KEY(matiere_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_classe (matiere_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_AF649A8BF46CD258 (matiere_id), INDEX IDX_AF649A8B8F5EA509 (classe_id), PRIMARY KEY(matiere_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, iduser_id INT NOT NULL, texte LONGTEXT NOT NULL, date DATE NOT NULL, destinateur VARCHAR(30) NOT NULL, emetteur VARCHAR(30) NOT NULL, INDEX IDX_B6BD307F786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, idpuser_id INT NOT NULL, texte LONGTEXT NOT NULL, date DATE NOT NULL, INDEX IDX_AF3C677959A50A1F (idpuser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quizz_id INT NOT NULL, titre LONGTEXT NOT NULL, reponse LONGTEXT NOT NULL, choix LONGTEXT NOT NULL, INDEX IDX_B6F7494EBA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, nom VARCHAR(30) NOT NULL, INDEX IDX_2D737AEFCCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, adresse VARCHAR(30) NOT NULL, grade VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6498F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE matiere_user ADD CONSTRAINT FK_FE415017F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_user ADD CONSTRAINT FK_FE415017A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_classe ADD CONSTRAINT FK_AF649A8BF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_classe ADD CONSTRAINT FK_AF649A8B8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677959A50A1F FOREIGN KEY (idpuser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere_classe DROP FOREIGN KEY FK_AF649A8B8F5EA509');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498F5EA509');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFCCF9E01E');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF46CD258');
        $this->addSql('ALTER TABLE matiere_user DROP FOREIGN KEY FK_FE415017F46CD258');
        $this->addSql('ALTER TABLE matiere_classe DROP FOREIGN KEY FK_AF649A8BF46CD258');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBA934BCD');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBA934BCD');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96D823E37A');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBAB22EE9');
        $this->addSql('ALTER TABLE matiere_user DROP FOREIGN KEY FK_FE415017A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F786A81FB');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677959A50A1F');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE fullname');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE matiere_user');
        $this->addSql('DROP TABLE matiere_classe');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE user');
    }
}
