<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephoneNumber;

    /**
     * @ORM\Column(type="text")
     */
    private $email;

    /**
     * Get id
     *
     * @return int
     */
    
    public static function loadValidatorMetadata(ClassMetadata $metadata){
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('telephoneNumber', new Assert\Type(array(
//            'type' => 'integer',
//            'message' => 'Podana wartość {{ value }} nie jest liczbą. ',
//        )));
        $metadata->addPropertyConstraint('telephoneNumber', new Assert\Length(array(
            'min' => '9',
            'max' => '9',
            'exactMessage' => 'nr telefonu zawiera 9 cyfr ',
        )));
        $metadata->addPropertyConstraint('email', new Assert\Email(array(
            'message' => 'Niepoprawny adres email',
            'checkMX' => false,
        )));
        
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set telephoneNumber
     *
     * @param string $telephoneNumber
     *
     * @return Contact
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;

        return $this;
    }

    /**
     * Get telephoneNumber
     *
     * @return string
     */
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}

