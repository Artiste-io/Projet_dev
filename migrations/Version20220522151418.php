<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522151418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_1599687D44F05E5');
        $this->addSql('DROP INDEX UNIQ_1599687F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__artist AS SELECT id, images_id, username, roles, password, email, verifier, disponible, types, photo FROM artist');
        $this->addSql('DROP TABLE artist');
        $this->addSql('CREATE TABLE artist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, images_id INTEGER DEFAULT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, verifier BOOLEAN NOT NULL, disponible BOOLEAN NOT NULL, types INTEGER NOT NULL, photo VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1599687D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO artist (id, images_id, username, roles, password, email, verifier, disponible, types, photo) SELECT id, images_id, username, roles, password, email, verifier, disponible, types, photo FROM __temp__artist');
        $this->addSql('DROP TABLE __temp__artist');
        $this->addSql('CREATE INDEX IDX_1599687D44F05E5 ON artist (images_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1599687F85E0677 ON artist (username)');
        $this->addSql('DROP INDEX IDX_D30212B98D7B4FB4');
        $this->addSql('DROP INDEX IDX_D30212B9B7970CF8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__artist_tags AS SELECT artist_id, tags_id FROM artist_tags');
        $this->addSql('DROP TABLE artist_tags');
        $this->addSql('CREATE TABLE artist_tags (artist_id INTEGER NOT NULL, tags_id INTEGER NOT NULL, PRIMARY KEY(artist_id, tags_id), CONSTRAINT FK_D30212B9B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D30212B98D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO artist_tags (artist_id, tags_id) SELECT artist_id, tags_id FROM __temp__artist_tags');
        $this->addSql('DROP TABLE __temp__artist_tags');
        $this->addSql('CREATE INDEX IDX_D30212B98D7B4FB4 ON artist_tags (tags_id)');
        $this->addSql('CREATE INDEX IDX_D30212B9B7970CF8 ON artist_tags (artist_id)');
        $this->addSql('DROP INDEX UNIQ_35D4282C19EB6921');
        $this->addSql('DROP INDEX UNIQ_35D4282CB7970CF8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commandes AS SELECT id, artist_id, client_id, image, titre FROM commandes');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('CREATE TABLE commandes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, artist_id INTEGER NOT NULL, client_id INTEGER NOT NULL, image VARCHAR(255) NOT NULL, titre VARCHAR(180) DEFAULT NULL, CONSTRAINT FK_35D4282C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35D4282CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commandes (id, artist_id, client_id, image, titre) SELECT id, artist_id, client_id, image, titre FROM __temp__commandes');
        $this->addSql('DROP TABLE __temp__commandes');
        $this->addSql('CREATE INDEX IDX_35D4282C19EB6921 ON commandes (client_id)');
        $this->addSql('CREATE INDEX IDX_35D4282CB7970CF8 ON commandes (artist_id)');
        $this->addSql('DROP INDEX IDX_7B9FFEB38D7B4FB4');
        $this->addSql('DROP INDEX IDX_7B9FFEB38BF5C2E6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commandes_tags AS SELECT commandes_id, tags_id FROM commandes_tags');
        $this->addSql('DROP TABLE commandes_tags');
        $this->addSql('CREATE TABLE commandes_tags (commandes_id INTEGER NOT NULL, tags_id INTEGER NOT NULL, PRIMARY KEY(commandes_id, tags_id), CONSTRAINT FK_7B9FFEB38BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7B9FFEB38D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commandes_tags (commandes_id, tags_id) SELECT commandes_id, tags_id FROM __temp__commandes_tags');
        $this->addSql('DROP TABLE __temp__commandes_tags');
        $this->addSql('CREATE INDEX IDX_7B9FFEB38D7B4FB4 ON commandes_tags (tags_id)');
        $this->addSql('CREATE INDEX IDX_7B9FFEB38BF5C2E6 ON commandes_tags (commandes_id)');
        $this->addSql('DROP INDEX UNIQ_B6BD307F19EB6921');
        $this->addSql('DROP INDEX UNIQ_B6BD307FB7970CF8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__message AS SELECT id, artist_id, client_id, content FROM message');
        $this->addSql('DROP TABLE message');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, artist_id INTEGER NOT NULL, client_id INTEGER NOT NULL, content CLOB NOT NULL, CONSTRAINT FK_B6BD307FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B6BD307F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO message (id, artist_id, client_id, content) SELECT id, artist_id, client_id, content FROM __temp__message');
        $this->addSql('DROP TABLE __temp__message');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6BD307F19EB6921 ON message (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6BD307FB7970CF8 ON message (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1599687F85E0677');
        $this->addSql('DROP INDEX IDX_1599687D44F05E5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__artist AS SELECT id, images_id, username, roles, password, email, verifier, disponible, types, photo FROM artist');
        $this->addSql('DROP TABLE artist');
        $this->addSql('CREATE TABLE artist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, images_id INTEGER DEFAULT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, verifier BOOLEAN NOT NULL, disponible BOOLEAN NOT NULL, types INTEGER NOT NULL, photo VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO artist (id, images_id, username, roles, password, email, verifier, disponible, types, photo) SELECT id, images_id, username, roles, password, email, verifier, disponible, types, photo FROM __temp__artist');
        $this->addSql('DROP TABLE __temp__artist');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1599687F85E0677 ON artist (username)');
        $this->addSql('CREATE INDEX IDX_1599687D44F05E5 ON artist (images_id)');
        $this->addSql('DROP INDEX IDX_D30212B9B7970CF8');
        $this->addSql('DROP INDEX IDX_D30212B98D7B4FB4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__artist_tags AS SELECT artist_id, tags_id FROM artist_tags');
        $this->addSql('DROP TABLE artist_tags');
        $this->addSql('CREATE TABLE artist_tags (artist_id INTEGER NOT NULL, tags_id INTEGER NOT NULL, PRIMARY KEY(artist_id, tags_id))');
        $this->addSql('INSERT INTO artist_tags (artist_id, tags_id) SELECT artist_id, tags_id FROM __temp__artist_tags');
        $this->addSql('DROP TABLE __temp__artist_tags');
        $this->addSql('CREATE INDEX IDX_D30212B9B7970CF8 ON artist_tags (artist_id)');
        $this->addSql('CREATE INDEX IDX_D30212B98D7B4FB4 ON artist_tags (tags_id)');
        $this->addSql('DROP INDEX IDX_35D4282C19EB6921');
        $this->addSql('DROP INDEX IDX_35D4282CB7970CF8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commandes AS SELECT id, client_id, artist_id, image, titre FROM commandes');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('CREATE TABLE commandes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, artist_id INTEGER NOT NULL, image VARCHAR(255) NOT NULL, titre VARCHAR(180) DEFAULT NULL)');
        $this->addSql('INSERT INTO commandes (id, client_id, artist_id, image, titre) SELECT id, client_id, artist_id, image, titre FROM __temp__commandes');
        $this->addSql('DROP TABLE __temp__commandes');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_35D4282C19EB6921 ON commandes (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_35D4282CB7970CF8 ON commandes (artist_id)');
        $this->addSql('DROP INDEX IDX_7B9FFEB38BF5C2E6');
        $this->addSql('DROP INDEX IDX_7B9FFEB38D7B4FB4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commandes_tags AS SELECT commandes_id, tags_id FROM commandes_tags');
        $this->addSql('DROP TABLE commandes_tags');
        $this->addSql('CREATE TABLE commandes_tags (commandes_id INTEGER NOT NULL, tags_id INTEGER NOT NULL, PRIMARY KEY(commandes_id, tags_id))');
        $this->addSql('INSERT INTO commandes_tags (commandes_id, tags_id) SELECT commandes_id, tags_id FROM __temp__commandes_tags');
        $this->addSql('DROP TABLE __temp__commandes_tags');
        $this->addSql('CREATE INDEX IDX_7B9FFEB38BF5C2E6 ON commandes_tags (commandes_id)');
        $this->addSql('CREATE INDEX IDX_7B9FFEB38D7B4FB4 ON commandes_tags (tags_id)');
        $this->addSql('DROP INDEX UNIQ_B6BD307FB7970CF8');
        $this->addSql('DROP INDEX UNIQ_B6BD307F19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__message AS SELECT id, artist_id, client_id, content FROM message');
        $this->addSql('DROP TABLE message');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, artist_id INTEGER NOT NULL, client_id INTEGER NOT NULL, content CLOB NOT NULL)');
        $this->addSql('INSERT INTO message (id, artist_id, client_id, content) SELECT id, artist_id, client_id, content FROM __temp__message');
        $this->addSql('DROP TABLE __temp__message');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6BD307FB7970CF8 ON message (artist_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6BD307F19EB6921 ON message (client_id)');
    }
}
