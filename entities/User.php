<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="user_name", type="string", length=70, nullable=true, unique=false)
     */
    private $userName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=150, nullable=true, unique=false)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_number", type="string", length=15, nullable=true, unique=false)
     */
    private $phoneNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_address", type="string", length=50, nullable=true, unique=false)
     */
    private $emailAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pass", type="string", length=200, nullable=true, unique=false)
     */
    private $pass;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=100, nullable=true, unique=false)
     */
    private $photo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="users",cascade={"persist"})
     * @ORM\JoinTable(name="orders",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products= new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get the value of products
     *
     * @return  \Doctrine\Common\Collections\Collection
     */ 

    /**
     * Get the value of userName
     *
     * @return  string|null
     */ 
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @param  string|null  $userName
     *
     * @return  self
     */ 
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of address
     *
     * @return  string|null
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string|null  $address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of photo
     *
     * @return  string|null
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @param  string|null  $photo
     *
     * @return  self
     */ 
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of emailAddress
     *
     * @return  string|null
     */ 
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set the value of emailAddress
     *
     * @param  string|null  $emailAddress
     *
     * @return  self
     */ 
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get the value of phoneNumber
     *
     * @return  string|null
     */ 
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @param  string|null  $phoneNumber
     *
     * @return  self
     */ 
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the value of pass
     *
     * @return  string|null
     */ 
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @param  string|null  $pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of products_id
     *
     * @return  \Doctrine\Common\Collections\Collection
     */ 
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set the value of products_id
     *
     * @return  self
     */ 
    public function setProducts_id(\Product $product)
    {
        $product->setUsers($this);
        $this->products[] = $product;

        return $this;
    }
}
