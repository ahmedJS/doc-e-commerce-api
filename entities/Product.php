<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=70, nullable=true, unique=false)
     */
    private $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="price_us", type="integer", nullable=true, unique=false)
     */
    private $priceUs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="discount", type="decimal", precision=5, scale=4, nullable=true, unique=false)
     */
    private $discount;

    /**
     * @var array|null
     *
     * @ORM\Column(name="images", type="json", nullable=true, unique=false)
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="products",cascade={"persist"})
          * @ORM\JoinTable(name="orders",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $users = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get the value of priceUs
     *
     * @return  int|null
     */ 
    public function getPriceUs()
    {
        return $this->priceUs;
    }

    /**
     * Set the value of priceUs
     *
     * @param  int|null  $priceUs
     *
     * @return  self
     */ 
    public function setPriceUs($priceUs)
    {
        $this->priceUs = $priceUs;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string|null
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string|null  $title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of users_id
     *
     * @return  \Doctrine\Common\Collections\Collection
     */ 
    public function getUsers_id()
    {
        return $this->users;
    }

    /**
     * Set the value of users_id
     *
     * @param  \Doctrine\Common\Collections\Collection  $users_id
     *
     * @return  self
     */ 
    public function setUsers(\User $user)
    {
        $this->users[] = $user;

        return $this;
    }
}
