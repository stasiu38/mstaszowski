<?
// src/Entity/Task.php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
class Task
{
	/**
     * @Assert\NotBlank()
     */
	 
	private $name;
	private $surname;
	 /**
     * @Assert\File(
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png"},
     *     mimeTypesMessage = "Zły format pliku image"
     * )
     */
	private $file;
	
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	public function getSurname()
	{
		return $this->surname;
	}
	public function setSurname($surname)
	{
		$this->surname = $surname;
	}
	public function getFile()
	{
		return $this->file;
	}
	public function setFile($file)
	{
		$this->file = $file;
	}
}
		