<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;
    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Films", mappedBy="category")
    */
    private $film;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Category
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }


    /**
     * Add movie
     *
     * @param \AppBundle\Entity\Films $film
     *
     * @return Category
     */
    public function addFilm(\AppBundle\Entity\Films $films)
    {
        $this->$films[] = $films;
        return $this;
    }
    /**
     * Remove movie
     *
     * @param \AppBundle\Entity\Films $films
     */
    public function deleteFilm(\AppBundle\Entity\Films $films)
    {
        $this->film->removeElement($films);
    }
    /**
     * Get movie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovie()
    {
        return $this->film;
    }
}

