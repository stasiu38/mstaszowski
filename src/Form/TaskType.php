<?
// src/Form/TaskType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->setAction('send')
            ->add('name', TextType::class, array('label' => 'Imię'))
            ->add('surname', TextType::class, array('label' => 'Nazwisko', 'required'   => false))
            ->add('file', FileType::class, array('label' => 'Plik'))
            ->add('Wyslij', SubmitType::class)
        ;
    }
}