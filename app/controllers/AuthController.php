<?php

namespace App\controllers;

use Ryxo\Controller;

class AuthController extends Controller
{
    private \PDO $conn;
    private int $page_size = 10;
    public function __construct()
    {
        parent::__construct();
        $this->conn = new \PDO("mysql:host=".$_ENV["DB_HOST"].";dbname=".$_ENV["DB_NAME"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
    }
    public function search($req)
    {
        if (isset($req->body['query']) && strlen($req->body['query']) > 2) {
            $term = $req->body['query'];
            $page = isset($req->body['page']) ? intval($req->body['page']) : 0;
            $type = $req->body['type'] ?? "site";
            if ($type == 'site') {
                $this->siteSearch($term, $page);
            } else if ($type == 'img') {
                $this->imgSearch($term);
            } else if ($type == 'vid') {
                $this->vidSearch($term);
            } else {
                $req->redirect('/');
            }
        } else {
            $req->redirect('/');
        }
    }
    public function siteSearch($query, $page)
    {
        $offset = $page * $this->page_size;
        $term = preg_replace("/\s+/", "%%", "%" . $query . "%");
        $sql = $this->conn->prepare("SELECT *, ( (title LIKE :term) + (description LIKE :term) + (keywords LIKE :term) ) as count_words FROM sites WHERE (title LIKE :term OR description LIKE :term OR keywords LIKE :term ) ORDER BY count_words DESC LIMIT 10 OFFSET :from_result");
        $sql->bindParam(':term', $term);
        $sql->bindParam(':from_result', $offset, \PDO::PARAM_INT);
        $sql->execute();
        $num_results = $sql->rowCount();
        if ($num_results > 0) {
            $this->render("search", ['title' => $query, 'term' => $query, 'type' => 'site', 'num_results' => $num_results, 'query' => $sql]);
        } else {
            $this->render("no-result", ['title' => $query, 'term' => $query, 'type' => 'site']);
        }
    }
    public function imgSearch($query)
    {
        $this->render("imgResult", ['title' => $query, 'term' => $query, 'type' => 'img']);
    }
    public function vidSearch($query)
    {
        $this->render("vidResult", ['title' => $query, 'term' => $query, 'type' => 'vid']);
    }
    public function __destruct()
    {
        unset($this->conn);
    }
}
