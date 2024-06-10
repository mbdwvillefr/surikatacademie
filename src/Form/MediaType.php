<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Upload File',
                'mapped' => false,
                //这表示这个表单字段不直接映射到实体的任何属性上。在这种情况下，文件上传字段不会直接映射到Media实体类中的任何属性。相反，我们需要在表单处理逻辑中手动处理文件的上传和存储。
                //Ceci indique que ce champ de formulaire n’est directement associé à aucune propriété de l’entité. Dans ce cas, le champ de chargement de fichier n’est directement associé à aucun attribut de la classe entité média. Au lieu de cela, nous devons gérer manuellement le chargement et le stockage des fichiers dans la logique de traitement des formulaires.
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
