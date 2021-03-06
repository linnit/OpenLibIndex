<?php

class DBO
{
    public function __construct()
    {
        $dbhost="localhost";
        $dbname="whatboox";
        $dbuser="whatboox";
        $dbpass="";
    
        try {
            $this->handle = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $this->handle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
            $this->handle->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            echo 'Error: ' .$e->getMessage();
            throw new \PDOException("Error connecting to database.");
        }
    }

    public function prepareStatements()
    {
        $this->prepareBookIns();
        $this->prepareCoverIns();
        $this->prepareISBNIns();
        $this->prepareIdentIns();
        $this->prepareSubIns();
        $this->prepareAuthorIndIns();
    }

    public function prepareSearch()
    {
        $this->search_key = "";
        $this->search_stmt = $this->handle->prepare("SELECT id FROM book WHERE `key`=:key");
        $this->search_stmt->bindParam(":key", $this->search_key);
    }

    public function prepareBookIns()
    {
        $this->book_title = "";
        $this->book_subtitle = "";
        $this->book_numbers_of_pages = "";
        $this->book_key = "";
        $this->book_publish_date = "";
        $this->book_by_statement = "";

        $this->book_stmt = $this->handle->prepare("INSERT INTO book VALUES(NULL, :title,
      :subtitle, :numbers_of_pages, :key, :publish_date, :by_statement)");
        $this->book_stmt->bindParam(":title", $this->book_title);
        $this->book_stmt->bindParam(":subtitle", $this->book_subtitle);
        $this->book_stmt->bindParam(":numbers_of_pages", $this->book_numbers_of_pages);
        $this->book_stmt->bindParam(":key", $this->book_key);
        $this->book_stmt->bindParam(":publish_date", $this->book_publish_date);
        $this->book_stmt->bindParam(":by_statement", $this->book_by_statement);
    }
    public function prepareCoverIns()
    {
        $this->cover_bid = 0;
        $this->cover_cover = "";
        $this->cover_stmt = $this->handle->prepare("INSERT INTO covers VALUES(NULL, :bid, :cover)");
        $this->cover_stmt->bindParam(":bid", $this->cover_bid);
        $this->cover_stmt->bindParam(":cover", $this->cover_cover);
    }
    public function prepareISBNIns()
    {
        $this->isbn_bid = 0;
        $this->isbn_isbn = "";
        $this->isbn_format = "";
        $this->isbn_stmt = $this->handle->prepare("INSERT INTO isbn VALUES(NULL, :bid, :isbn, :format)");
        $this->isbn_stmt->bindParam(":bid", $this->isbn_bid);
        $this->isbn_stmt->bindParam(":isbn", $this->isbn_isbn);
        $this->isbn_stmt->bindParam(":format", $this->isbn_format);
    }
    public function prepareIdentIns()
    {
        $this->iden_bid = 0;
        $this->iden_ident = "";
        $this->iden_site = "";
        $this->ident_stmt = $this->handle->prepare("INSERT INTO identifiers VALUES(NULL, :bid, :identifier, :site)");
        $this->ident_stmt->bindParam(":bid", $this->iden_bid);
        $this->ident_stmt->bindParam(":identifier", $this->iden_ident);
        $this->ident_stmt->bindParam(":site", $this->iden_site);
    }
    public function prepareSubIns()
    {
        $this->subject_bid = 0;
        $this->subject_subject = "";
        $this->subject_stmt = $this->handle->prepare("INSERT INTO subjects VALUES(NULL, :bid, :subject)");
        $this->subject_stmt->bindParam(":bid", $this->subject_bid);
        $this->subject_stmt->bindParam(":subject", $this->subject_subject);
    }
    public function prepareAuthorIndIns()
    {
        $this->authorind_bid = 0;
        $this->authorind_key = "";
        $this->authorind_stmt = $this->handle->prepare("INSERT INTO author_index VALUES(:bid, :author_key)");
        $this->authorind_stmt->bindParam(":bid", $this->authorind_bid);
        $this->authorind_stmt->bindParam(":author_key", $this->authorind_key);
    }
    public function prepareDescIns()
    {
        $this->description_bid = 0;
        $this->description_subject = "";
        $this->description_stmt = $this->handle->prepare("INSERT INTO description VALUES(NULL, :bid, :description)");
        $this->description_stmt->bindParam(":bid", $this->description_bid);
        $this->description_stmt->bindParam(":description", $this->description_subject);
    }
}
