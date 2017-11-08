<?php
namespace VladimirBiro\ArticleManager;

use \Nette\Database\Context;


class ArticleList
{
    /** @var \Nette\Database\Context */
    private $database;



    // Konstanty
    const DEFAULT_LIMIT = 20,
          DEFAULT_SORT = 'time_add DESC',
          DEFAULT_OFFSET = 0,
          DEFAULT_ARTICLE_TABLE = 'article';



    private $articleTable = self::DEFAULT_ARTICLE_TABLE;



    private $articleList,
            $article;



    // Defaultne nastavenia
    private $public = 1;
    private $delete = 0;
    private $category = null;
    private $manufacturer = null;
    private $priceRange = null;
    private $whiteList = null;
    private $blackList = null;
    private $fulltext = null;
    private $limit = self::DEFAULT_LIMIT;
    private $offset = self::DEFAULT_OFFSET;
    private $order = self::DEFAULT_SORT;





    /**
     * ArticleManager constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->database = $context;
    }





    /**
     * Test test
     */
    public function testTest()
    {
        return 'Hello World';
    }






    /**
     * Vyresetuj kriteria na generovanie zoznamu artiklov
     */
    public function reset()
    {
        $this->category = null;
        $this->manufacturer = null;
        $this->priceRange = null;
        $this->whiteList = null;
        $this->blackList = null;
        $this->fulltext = null;
        $this->offset = self::DEFAULT_OFFSET;
    }






    /**
     * Nastav artikle podla kriterii
     * @return mixed
     */
    public function setArticles()
    {
        $return = $this->database
            ->table($this->articleTable);

        if (!is_null($this->fulltext)) {
            $return->where("name LIKE ?", "%$this->fulltext%");
        }

        if (!is_null($this->public)) {
            $return->where('is_public', $this->public);
        }

        if (!is_null($this->delete)) {
            $return->where('is_delete', $this->delete);
        }

        if ($this->whiteList !== null) {
            $return->where('article.id_article', (array)$this->whiteList);
            if (count($this->whiteList) > 0) {
                $return->order('FIELD(article.id_article, ?)', (array)$this->whiteList);
            }
        }

        if ($this->blackList) {
            $return->where('id_article NOT', (array)$this->blackList);
        }

        if ($this->category) {
            $return->where(':category_has_article.id_category', $this->category);
        }

        if ($this->manufacturer) {
            $return->where('id_manufacturer', $this->manufacturer);
        }

        if ($this->priceRange) {
            $return->where('(end_price >= ? AND end_price <= ?)', $this->priceRange[0], $this->priceRange[1]);
        }

        if ($this->limit || $this->offset) {
            $return->limit($this->limit, $this->offset);
        }

        $return->order($this->order);

        $return->group('id_article');

        $this->articleList = $return;
    }


    /**
     * Vrat zoznam artiklov
     * @return mixed
     */
    public function getArticleList()
    {
        return $this->articleList;
    }






    /**
     * Nastav artikle podla ID
     * @param $id
     */
    public function setArticleById($id)
    {
        $return = $this->database
            ->table($this->articleTable);

        if (!is_null($this->public)) {
            $return->where('is_public', $this->public);
        }

        if (!is_null($this->delete)) {
            $return->where('is_delete', $this->delete);
        }

        $this->article = $return->get($id);
    }


    /**
     * Vrat artikel
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }







    public function setFullText($fulltext)
    {
        $this->fulltext = $fulltext;
    }

    public function getFullText()
    {
        return $this->fulltext;
    }



    public function setPublic($public)
    {
        $this->public = $public;
    }

    public function getPublic()
    {
        return $this->public;
    }



    public function setDelete($delete)
    {
        $this->delete = $delete;
    }

    public function getDelete()
    {
        return $this->delete;
    }



    public function setWhiteList(array $whiteList)
    {
        $this->whiteList = $whiteList;
    }

    public function getWhiteLIst()
    {
        return $this->whiteList;
    }



    public function setBlackList(array $blackList)
    {
        $this->blackList = $blackList;
    }

    public function getBlackLIst()
    {
        return $this->blackList;
    }



    public function setCategory($id)
    {
        $this->category = $id;
    }

    public function getCategory()
    {
        return $this->category;
    }



    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }



    public function setPriceRange($min, $max)
    {
        $this->priceRange = [$min, $max];
    }

    public function getPriceRange()
    {
        return $this->priceRange;
    }



    public function setLimit($limit)
    {
        $this->limit = (int) $limit;
    }

    public function getLimit()
    {
        return $this->limit;
    }



    public function setOffset($offset)
    {
        $this->offset = (int) $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }



    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

}