<?php
namespace BBIT\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eko\FeedBundle\Item\Writer\RoutedItemInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_post")
 *
 */
class Post implements RoutedItemInterface
{
    const SHORTBODY_LENGTH = 200;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $body;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    public function getShortBody()
    {
        if (strlen($this->body) < SELF::SHORTBODY_LENGTH) {
            return $this->body;
        }

        return preg_replace('/\s+?(\S+)?$/', '', substr($this->body, 0, (SELF::SHORTBODY_LENGTH+1)))."...";
    }




    /**
     * This method returns feed item title
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemTitle(){
        return $this->title;
    }

    /**
     * This method returns feed item description (or content)
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemDescription(){
        return $this->getShortBody();
    }


    /**
     * This method returns item publication date
     *
     * @abstract
     *
     * @return \DateTime
     */
    public function getFeedItemPubDate(){
        return $this->createdAt;
    }

    public function getFeedItemRouteName(){
        return 'bbit_blog_view';
    }

    /**
     * This method returns the parameters for the route.
     *
     * @abstract
     *
     * @return array
     */
    public function getFeedItemRouteParameters(){
        return array('slug' => $this->slug);
    }

    public function getFeedItemUrlAnchor(){
        return '#';
    }

}
